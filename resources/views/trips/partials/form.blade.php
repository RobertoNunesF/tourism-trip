@php($trip = $trip ?? null)

<div class="space-y-4">
    <div class="grid grid-cols-2 gap-3">
        <div>
            <x-input-label for="origin" value="Origem" />
            <x-text-input id="origin" name="origin" type="text" class="mt-1 block w-full"
                           :value="old('origin', $trip->origin ?? '')" required autofocus />
            <x-input-error :messages="$errors->get('origin')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="destination" value="Destino" />
            <x-text-input id="destination" name="destination" type="text" class="mt-1 block w-full"
                           :value="old('destination', $trip->destination ?? '')" required />
            <x-input-error :messages="$errors->get('destination')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="vehicle_id" value="Veículo" />
        <select id="vehicle_id" name="vehicle_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-coinpel focus:ring-coinpel text-sm">
            <option value="">Selecione um veículo</option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}"
                    @selected(old('vehicle_id', $trip->vehicle_id ?? '') == $vehicle->id)>
                    {{ $vehicle->plate }} — {{ $vehicle->model }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="driver_id" value="Motorista" />
        <select id="driver_id" name="driver_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-coinpel focus:ring-coinpel text-sm">
            <option value="">Selecione um motorista</option>
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}"
                    @selected(old('driver_id', $trip->driver_id ?? '') == $driver->id)>
                    {{ $driver->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="departure_time" value="Data/hora de saída" />
        <x-text-input id="departure_time" name="departure_time" type="datetime-local" class="mt-1 block w-full"
                       :value="old('departure_time', $trip?->departure_time?->format('Y-m-d\TH:i'))" required />
        <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="arrival_time" value="Data/hora de chegada" />
        <x-text-input id="arrival_time" name="arrival_time" type="datetime-local" class="mt-1 block w-full"
                       :value="old('arrival_time', $trip?->arrival_time?->format('Y-m-d\TH:i'))" required />
        <x-input-error :messages="$errors->get('arrival_time')" class="mt-2" />
    </div>
</div>