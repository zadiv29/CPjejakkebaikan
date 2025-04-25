<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoluntripRequest;
use App\Models\Fundraiser;
use App\Models\Voluntrip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoluntripController extends Controller
{
    //
    public function index()
    {
        $voluntrips = Voluntrip::all();

        // $totalDonations = $voluntrips->totalReachedAmount();
        // $goalReached = $totalDonations >= $voluntrips->target_amount;

        // $hasRequestedWithdrawal = $voluntrips->withdrawals()->exists();

        // $percentage = ($totalDonations / $voluntrips->target_amount) * 100;
        // if ($percentage > 100) {
        //     $percentage = 100;
        // }

        return view('admin.voluntrip.index', compact('voluntrips'));
    }

    public function create()
    {
        //
        return view('admin.voluntrip.create');
    }

    public function store(StoreVoluntripRequest $request)
    {
        $fundraiser = Fundraiser::where('user_id', Auth::user()->id)->first();
        DB::transaction(function () use ($request, $fundraiser) {

            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $validated['fundraiser_id'] = $fundraiser->id;
            $validated['is_active'] = false;

            $fundraising = Voluntrip::create($validated);
        });
        return redirect()->route('admin.voluntrip.index');
    }
}
