<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoluntripRequest;
use App\Models\Fundraiser;
use App\Models\Voluntrip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoluntripController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->hasRole('owner')) {
            $voluntrips = Voluntrip::all();
        } else {
            $fundraiser = Fundraiser::where('user_id', Auth::user()->id)->first();
            $voluntrips = Voluntrip::where('fundraiser_id', $fundraiser->id)->get();
        }

        foreach ($voluntrips as $voluntrip) {
            $voluntrip->total_price = $voluntrip->ticket_price * $voluntrip->total_ticket;
        }

        return view('admin.voluntrip.index', compact('voluntrips'));
    }

    public function create()
    {
        //
        return view('admin.voluntrip.create');
    }

    public function store(StoreVoluntripRequest $request)
    {
        if (Auth::user()->hasRole('owner')) {
            $fundraiser = Fundraiser::firstOrCreate(
                ['user_id' => Auth::user()->id],
                ['name' => Auth::user()->name, 'is_active' => true]
            );
        } else {
            $fundraiser = Fundraiser::where('user_id', Auth::user()->id)->first();
        }
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

    public function show($slug)
    {
        $voluntrip = Voluntrip::where('slug', $slug)->firstOrFail();
        $date = Carbon::parse($voluntrip->start_date)->format('d F Y');
        $timeStart = Carbon::parse($voluntrip->start_time)->format('H.i');
        $timeEnd = Carbon::parse($voluntrip->end_time)->format('H.i');

        return view('admin.voluntrip.detail', compact('voluntrip', 'date', 'timeStart', 'timeEnd'));
    }

    public function update(Request $request, Voluntrip $voluntrip)
    {
        if ($request->input('action') === 'approve') {
            $voluntrip->is_active = true;
            $voluntrip->event_status = 'active';
            $voluntrip->save();

            return redirect()->route('admin.voluntrip.show', $voluntrip->slug)
                ->with('success', 'Voluntrip approved and activated successfully.');
        }

        if ($request->has('event_status') && auth()->user()->hasRole('fundraiser')) {
            $request->validate([
                'event_status' => 'in:active,completed',
            ]);

            $voluntrip->event_status = $request->input('event_status');
            $voluntrip->save();

            return redirect()->route('admin.voluntrip.show', $voluntrip->slug)
                ->with('success', 'Voluntrip approved and activated successfully.');
        }
    }
}
