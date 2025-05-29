<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoluntripRequest;
use App\Mail\SendTicketMail;
use App\Mail\VolunteerVerificationMail;
use App\Models\Volunteer;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fundraising;
use App\Http\Requests\StoreDonationRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Donatur;
use App\Models\Voluntrip;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        $fundraisings = Fundraising::with(['category', 'fundraiser'])
            ->where('is_active', 1)
            ->orderByDesc('id')
            ->get();

        $voluntrips = Voluntrip::where('event_status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('front.views.index', compact('categories', 'fundraisings', 'voluntrips'));
    }

    public function category(Category $category)
    {
        return view('front.views.category', compact('category'));
    }

    public function details(Fundraising $fundraising)
    {
        $goalReached = $fundraising->totalReachedAmount() >= $fundraising->target_amount;
        return view('front.views.details', compact('fundraising', 'goalReached'));
    }

    public function support(Fundraising $fundraising)
    {
        return view('front.views.donation', compact('fundraising'));
    }

    public function checkout(Fundraising $fundraising, $totalAmountDonation)
    {
        return view('front.views.checkout', compact('fundraising', 'totalAmountDonation'));
    }

    public function store(StoreDonationRequest $request, Fundraising $fundraising, $totalAmountDonation)
    {
        DB::transaction(function () use ($request, $fundraising, $totalAmountDonation) {

            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['fundraising_id'] = $fundraising->id;
            $validated['total_amount'] = $totalAmountDonation;
            $validated['is_paid'] = false;

            $donatur = Donatur::create($validated);
        });

        return redirect()->route('front.details', $fundraising->slug);
    }

    //SECTION - Voluntrip Section
    // NOTE Chekout voluntrip

    public function voluntripDetail(Request $request, Voluntrip $voluntrip)
    {
        $date = Carbon::parse($voluntrip->start_date)->format('d F Y');
        $timeStart = Carbon::parse($voluntrip->start_time)->format('H.i');
        $timeEnd = Carbon::parse($voluntrip->end_time)->format('H.i');

        // Active tab
        $tab = $request->query('tab', 'deskripsi');

        return (view('front.views.detail-voluntrip',   compact('voluntrip', 'date', 'timeStart', 'timeEnd', 'tab')));
    }

    public function createVolunteer(Voluntrip $voluntrip, Request $request)
    {
        $qty = $request->query('qty', 1);
        $total = $request->query('total', $voluntrip->ticket_price);
        $date = Carbon::parse($voluntrip->start_date)->format('d F Y');
        $timeStart = Carbon::parse($voluntrip->start_time)->format('H.i');
        $timeEnd = Carbon::parse($voluntrip->end_time)->format('H.i');

        return view('front.views.register-volunteer', [
            'voluntrip' => $voluntrip,
            'qty' => $qty,
            'total' => $total,
            'date' => $date,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
        ]);
    }
    public function volunteerStore(Request $request)
    {
        $validated = $request->validate([
            // 'qty' => 'required|integer|min:1',
            'volunteers' => 'required|array',
            'volunteers.*.name' => 'required|string',
            'volunteers.*.email' => 'required|email',
            'volunteers.*.number_phone' => 'required|string',
            // 'total' => 'required|numeric',
            'payment_channel' => 'required|string',
            'voluntrip_id' => 'required|exists:voluntrip,id',
        ]);

        $paymentChannel = $validated['payment_channel'];

        // Simpan dulu semua volunteer tanpa volunteer_payment_id
        $volunteers = [];
        foreach ($validated['volunteers'] as $volunteerData) {
            $volunteers[] = Volunteer::create([
                'name' => $volunteerData['name'],
                'email' => $volunteerData['email'],
                'number_phone' => $volunteerData['number_phone'],
                'voluntrip_id' => $request->voluntrip_id,
                'is_verified' => false,
                'verify_token' => Str::random(60),
            ]);
        }
        Mail::to($volunteers[0]->email)->send(new VolunteerVerificationMail($volunteers[0], $paymentChannel));
        return view('front.views.notification', ['volunteer' => $volunteers[0]]);
    }

    public function verifyVolunteer($token, $paymentChannel)
    {
        $volunteer = Volunteer::where('verify_token', $token)->firstOrFail();
        // Jika sudah punya pembayaran, arahkan ke halaman pembayaran
        if ($volunteer->payment) {
            if ($volunteer->payment->status === 'paid') {
                return redirect()->route('payment.already_verified', [
                    'payment' => $volunteer->payment->uuid
                ]); // Sudah dibayar
            }

            if ($volunteer->payment->status === 'expired') {
                return redirect()->route('payment.already_expired', [
                    'payment' => $volunteer->payment->uuid
                ]);
            }

            return redirect()->route('payment.information', [
                'payment' => $volunteer->payment->uuid
            ]);
        }

        // Ambil semua anggota kelompok dari voluntrip ini yang belum punya payment
        $relatedVolunteers = Volunteer::where('voluntrip_id', $volunteer->voluntrip_id)
            ->whereNull('volunteer_payments_id')
            ->get();

        $total = $relatedVolunteers->count() * $volunteer->voluntrip->ticket_price;

        $response = Http::withToken(env('OMMOPAY_API_TOKEN'))
            ->post(
                'https://api.ommopay.id/v1/virtual_account',
                [
                    'merchant_trx_id' => 'VL_' . time(),
                    'payment_channel' => $paymentChannel,
                    'amount' => $total,
                    'description' => 'Pembayaran untuk pendaftaran volunteer',
                    'expired_time' => now()->addMinutes(60)->toIso8601String(),
                    'callback_url' => route('payment.callback'),
                ]
            );


        if ($response->successful()) {
            $paymentData = $response->json();
            $data = $paymentData['data'];

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
            ]);
            foreach ($relatedVolunteers as $v) {
                $v->update(['volunteer_payments_id' => $payment->id]);
            }

            return redirect()->route('payment.information', ['payment' => $data['uuid']]);
        }

        return back()->withErrors('Gagal membuat Virtual Account. Silakan coba lagi.');
    }

    public function information(Payment $payment)
    {
        $numVolunteers = $payment->volunteers->count();
        $volunteer = $payment->volunteers->firstOrFail();
        $voluntrip = $volunteer->voluntrip;

        return view('front.views.payment-information', [
            'payment' => $payment,
            'numVolunteers' => $numVolunteers,
            'voluntrip' => $voluntrip
        ]);
    }

    public function getStatus(Payment $payment)
    {
        return response()->json(['status' => $payment->status]);
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
            if ($status === 'PAID') {
                $volunteers = $payment->volunteers;

                if ($volunteers->isNotEmpty()) {
                    $voluntrip = $volunteers->first()->voluntrip;

                    if ($voluntrip) {
                        $ticketCount = $volunteers->count();

                        if ($voluntrip->total_ticket >= $ticketCount) {
                            $voluntrip->decrement('total_ticket', $ticketCount);
                        }
                    }
                }
                foreach ($volunteers as $volunteer) {
                    // Kirim email ke alamat email masing-masing volunteer
                    // Mailable sudah menerima $volunteer, $voluntrip, $payment
                    Mail::to($volunteer->email)->send(new SendTicketMail($volunteer, $voluntrip, $payment));
                }
            }
        }
        return response()->json(['message' => 'Callback received']);
    }

    public function expiredPage(Payment $payment)
    {
        $numVolunteers = $payment->volunteers->count();
        $volunteer = $payment->volunteers->firstOrFail();
        $voluntrip = $volunteer->voluntrip;
        return view('front.views.already-expired', [
            'numVolunteers' => $numVolunteers,
            'payment' => $payment,
            'voluntrip' => $voluntrip
        ]);
    }

    public function alreadyPaid(Payment $payment)
    {
        $numVolunteers = $payment->volunteers->count();
        $volunteer = $payment->volunteers->firstOrFail();
        $voluntrip = $volunteer->voluntrip;
        return view('front.views.already-paid', [
            'numVolunteers' => $numVolunteers,
            'payment' => $payment,
            'voluntrip' => $voluntrip
        ]);
    }
}
