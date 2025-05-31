<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Mail\DonationVerificationMail;
use App\Models\Donatur;
use App\Models\Fundraising;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class DonationController extends Controller
{
    public function store(StoreDonationRequest $request, Fundraising $fundraising)
    {

        $donatur = null;
        $fundraisingData = $fundraising;

        DB::transaction(function () use ($request, $fundraising, &$donatur) {

            $validated = $request->validated();

            $paymentChannel = $validated['payment_channel'];
            $mailDonatur = $request->email;
            $validated['fundraising_id'] = $fundraising->id;
            $validated['is_paid'] = false;
            $validated['verify_token'] = Str::random(60);
            $amount = $request->amount;

            $donatur = Donatur::create($validated);

            Mail::to($mailDonatur)->send(new DonationVerificationMail($donatur, $paymentChannel, $fundraising, $amount));
        });
        return view('front.views.donation.notification', [
            'donatur' => $donatur,
            'fundraising' => $fundraisingData
        ]);
    }

    public function verifyDonation($token, $paymentChannel, $amount)
    {
        $donatur = Donatur::where('verify_token', $token)->firstOrFail();

        if ($donatur->payment) {
            if ($donatur->payment->status === 'paid') {
                return redirect()->route('payment.donation.already_verified', [
                    'payment' => $donatur->payment->uuid
                ]);
            }
            if ($donatur->payment->status === 'expired') {
                return redirect()->route('payment.donation.already_expired', [
                    'payment' => $donatur->payment->uuid
                ]);
            }

            return redirect()->route('payment.donation.information', [
                'payment' => $donatur->payment->uuid
            ]);
        }

        $fundraising = $donatur->fundraising;

        $response = Http::withToken(env('OMMOPAY_API_TOKEN'))
            ->post(
                'https://api.ommopay.id/v1/virtual_account',
                [
                    'merchant_trx_id' => 'DN_' . time(),
                    'payment_channel' => $paymentChannel,
                    'amount' => $amount,
                    'description' => "Pembayaran donasi untuk " . $fundraising->name,
                    'expired_time' => now()->addMinutes(60)->toIso8601String(),
                    'callback_url' => route('payment.donation.callback'),
                ]
            );

        if ($response->successful()) {
            $dataDonation = $response->json();
            $data = $dataDonation['data'];

            $expiredAt = Carbon::parse($data['expired_time'])->format('Y-m-d H:i:s');

            $payment = Payment::create([
                'uuid' => $data['uuid'],
                'merchant_trx_id' => $data['merchant_trx_id'],
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'payment_channel' => $data['payment_channel'],
                'va_number' => $data['va_number'],
                'expired_at' => $expiredAt,
                'status' => 'pending',
                'payment_type' => 'donasi',
                'donatur_id' => $donatur->id
            ]);
            return redirect()->route('payment.donation.information', ['payment' => $data['uuid']]);
        }

        return back()->withErrors('Gagal membuat Virtual Account. Silakan coba lagi.');
    }

    public function information(Payment $payment)
    {
        $donatur = $payment->donaturs;
        $fundraising = $donatur->fundraising;

        return view('front.views.donation.payment-donation-information', [
            'donatur' => $donatur,
            'payment' => $payment,
            'fundraising' => $fundraising
        ]);
    }

    public function expiredPage(Payment $payment)
    {
        $donatur = $payment->donaturs;
        $fundraising = $donatur->fundraising;

        return view('front.views.donation.already-expired', [
            'donatur' => $donatur,
            'payment' => $payment,
            'fundraising' => $fundraising
        ]);
    }

    public function alreadyPaid(Payment $payment)
    {
        $donatur = $payment->donaturs;
        $fundraising = $donatur->fundraising;
        return view('front.views.donation.already-paid', [
            'donatur' => $donatur,
            'payment' => $payment,
            'fundraising' => $fundraising
        ]);
    }

    public function paymentCallback(Request $request)
    {

        $uuid = $request->input('uuid');
        $status = $request->input('status');

        $payment = Payment::where('uuid', $uuid)->first();

        if ($payment) {
            $payment->update([
                'status' => $status,
            ]);
        }
        if ($status === 'PAID') {
            $donatur = $payment->donaturs;

            if ($donatur) {
                if (!$donatur->is_paid) {
                    $donatur->update([
                        'is_paid' => true
                    ]);
                }
                $fundraising = $donatur->fundraising;
                if ($fundraising) {
                    $currentReachedAmount = $fundraising->totalReachedAmount();

                    if ($currentReachedAmount >= $fundraising->target_amount && !$fundraising->has_finished) {
                        $fundraising->update([
                            'has_finished' => true
                        ]);
                    }
                }
            }
        }
        return response()->json(['message' => 'Callback received']);
    }
}
