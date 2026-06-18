<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $drivers = Driver::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->string('q') . '%')
                        ->orWhere('cnh_number', 'like', '%' . $request->string('q') . '%')
                        ->orWhere('phone', 'like', '%' . $request->string('q') . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::latest()->paginate(10);

        return view('drivers.create', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        Driver::create($request->validated());

        return redirect()->route('drivers.index')
            ->with('success', 'Motorista cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        $drivers = Driver::latest()->paginate(10);

        return view('drivers.edit', compact('driver', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'cnh_number' => 'required|digits:11|unique:drivers,cnh_number,' . $driver->id,
        ]);

        $driver->update($validated);

        return redirect()->route('drivers.index')
            ->with('success', 'Motorista atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        if ($driver->trips()->exists()) {
            return redirect()->route('drivers.index')
                ->with('error', 'Não é possível excluir um motorista vinculado a viagens.');
        }

        $driver->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Motorista excluído com sucesso!');
    }
}