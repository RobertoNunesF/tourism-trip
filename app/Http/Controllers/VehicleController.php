<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('model', 'like', '%' . $request->string('q') . '%')
                        ->orWhere('plate', 'like', '%' . $request->string('q') . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::latest()->paginate(10);

        return view('vehicles.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        Vehicle::create($request->validated());

        return redirect()->route('vehicles.index')
            ->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicles = Vehicle::latest()->paginate(10);

        return view('vehicles.edit', compact('vehicle', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'plate' => [
                'required',
                'string',
                'regex:/^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/i',
                'unique:vehicles,plate,' . $vehicle->id,          
            ] 
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->trips()->exists()) {
            return redirect()->route('vehicles.index')
                ->with('error', 'Não é possível excluir um veículo que possui viagens vinculadas.');
        }

        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Veículo excluído com sucesso!');
    }
}