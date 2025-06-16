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
            $paidTickets = $voluntrip->volunteers()
                ->whereHas('payment', fn ($q) => $q->where('status', 'PAID'))
                ->count();

            $totalTickets = $voluntrip->total_ticket + $paidTickets;

            $percentage = $totalTickets > 0 ? round(($paidTickets / $totalTickets) * 100, 2) : 0;

            $voluntrip->total_price = $paidTickets * $voluntrip->ticket_price;
            $voluntrip->funded_percentage = $percentage;
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

            try {
                // Menggabungkan hari, bulan, dan tahun menjadi objek Carbon
                $startDate = Carbon::create(
                    $validated['start_date_year'],
                    $validated['start_date_month'],
                    $validated['start_date_day']
                )->startOfDay(); // Menetapkan waktu ke 00:00:00 untuk konsistensi

                // Menambahkan tanggal yang sudah digabung ke array validated
                $validated['start_date'] = $startDate;

                // Opsional: Hapus input terpisah dari $validated jika tidak diperlukan lagi
                unset($validated['start_date_day']);
                unset($validated['start_date_month']);
                unset($validated['start_date_year']);
            } catch (\Exception $e) {
                // Menangani error jika tanggal yang digabungkan tidak valid (misal: 31 Februari)
                return redirect()->back()->withErrors([
                    'start_date' => 'Tanggal mulai yang dimasukkan tidak valid.'
                ])->withInput();
            }

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
        $dateForInput = Carbon::parse($voluntrip->start_date)->format('Y-m-d');
        $timeStartInput = Carbon::parse($voluntrip->start_time)->format('H:i');
        $timeEndInput = Carbon::parse($voluntrip->end_time)->format('H:i');

        return view('admin.voluntrip.detail', compact('voluntrip', 'date', 'timeStart', 'timeEnd', 'dateForInput', 'timeStartInput', 'timeEndInput'));
    }

    public function update(Request $request, Voluntrip $voluntrip)
    {
        if ($request->has('ticket_price')) {
            $request->merge([
                'ticket_price' => (int) str_replace('.', '', $request->input('ticket_price')),
            ]);
        }

        if ($request->input('action') === 'approve') {
            $voluntrip->is_active = true;
            $voluntrip->event_status = 'active';
            $voluntrip->save();

            return redirect()->route('admin.voluntrip.show', $voluntrip->slug)
                ->with('success', 'Voluntrip approved and activated successfully.');
        }

        if ($request->has('event_status') && auth()->user()->hasRole('fundraiser')) {
            $validated = $request->validate([
                'event_status' => 'nullable|in:active,completed',
                'start_date'   => 'nullable|date',
                'start_time'   => 'nullable|date_format:H:i',
                'end_time'     => 'nullable|date_format:H:i|after_or_equal:start_time',
                'ticket_price' => 'nullable|numeric|min:0',
                'total_ticket' => 'nullable|integer|min:1',
            ]);

            $voluntrip->fill(array_filter($validated));
            $voluntrip->save();

            return redirect()->route('admin.voluntrip.show', $voluntrip->slug)
                ->with('success', 'Voluntrip approved and activated successfully.');
        }
        if (auth()->user()->hasRole('owner')) {
            $validated = $request->validate([
                'event_status' => 'nullable|in:active,completed',
                'start_date'   => 'nullable|date',
                'start_time'   => 'nullable|date_format:H:i',
                'end_time'     => 'nullable|date_format:H:i|after_or_equal:start_time',
                'ticket_price' => 'nullable|numeric|min:0',
                'total_ticket' => 'nullable|integer|min:1',
            ]);

            $voluntrip->fill(array_filter($validated));
            $voluntrip->save();

            return redirect()->route('admin.voluntrip.show', $voluntrip->slug)
                ->with('success', 'Voluntrip updated successfully.');
        }
    }

    public function destroy(Voluntrip $voluntrip)
    {
        DB::beginTransaction();

        try {
            $voluntrip->delete();
            DB::commit();
            return redirect()->route('admin.voluntrip.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.categories.index');
        }
    }
}
