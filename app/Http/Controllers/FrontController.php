<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoluntripRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fundraising;
use App\Http\Requests\StoreDonationRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Donatur;
use App\Models\Voluntrip;
use Carbon\Carbon;

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

        $voluntrips = Voluntrip::where('is_active', 1)->get();

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
}
