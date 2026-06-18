<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Driver;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trips = Trip::with(['vehicle', 'driver'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('origin', 'like', '%' . $request->string('q') . '%')
                        ->orWhere('destination', 'like', '%' . $request->string('q') . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $trips = Trip::with(['vehicle', 'driver'])->latest()->paginate(10);

        return view('trips.create', compact('vehicles', 'drivers', 'trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules(afterNow: true));

        if ($conflict = $this->findSchedulingConflict($validated)) {
            return back()->withInput()->withErrors($conflict);
        }

        Trip::create($validated);

        return redirect()->route('trips.index')
            ->with('success', 'Viagem agendada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $trips = Trip::with(['vehicle', 'driver'])->latest()->paginate(10);

        return view('trips.edit', compact('trip', 'vehicles', 'drivers', 'trips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate($this->validationRules());

        if ($conflict = $this->findSchedulingConflict($validated, exceptTripId: $trip->id)) {
            return back()->withInput()->withErrors($conflict);
        }

        $trip->update($validated);

        return redirect()->route('trips.index')
            ->with('success', 'Viagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect()->route('trips.index')
            ->with('success', 'Viagem cancelada com sucesso!');
    }

    /**
     * Validation rules shared by store() and update().
     *
     * @return array<string, string>
     */
    private function validationRules(bool $afterNow = false): array
    {
        return [
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date' . ($afterNow ? '|after:now' : ''),
            'arrival_time' => 'required|date|after:departure_time',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
        ];
    }

    /**
     * Checks if the chosen vehicle or driver is already scheduled for
     * another trip at the same departure time.
     *
     * @param  array<string, mixed>  $validated
     * @return array<string, string>|null  Error bag for withErrors(), or null if free.
     */
    private function findSchedulingConflict(array $validated, ?int $exceptTripId = null): ?array
    {
        $vehicleBusy = Trip::where('vehicle_id', $validated['vehicle_id'])
            ->where('departure_time', $validated['departure_time'])
            ->when($exceptTripId, fn ($query) => $query->where('id', '!=', $exceptTripId))
            ->exists();

        if ($vehicleBusy) {
            return ['vehicle_id' => 'Este veículo já está escalado para uma viagem neste mesmo horário.'];
        }

        $driverBusy = Trip::where('driver_id', $validated['driver_id'])
            ->where('departure_time', $validated['departure_time'])
            ->when($exceptTripId, fn ($query) => $query->where('id', '!=', $exceptTripId))
            ->exists();

        if ($driverBusy) {
            return ['driver_id' => 'Este motorista já está escalado para uma viagem neste mesmo horário.'];
        }

        return null;
    }
}