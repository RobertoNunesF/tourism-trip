@php($vehicle = $vehicle ?? null)

<div class="space-y-4">
    <div>
        <x-input-label for="model" value="Modelo" />
        <x-text-input id="model" name="model" type="text" class="mt-1 block w-full"
                       :value="old('model', $vehicle->model ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('model')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="plate" value="Placa" />
        <x-text-input id="plate" name="plate" type="text" class="mt-1 block w-full uppercase"
                       :value="old('plate', $vehicle->plate ?? '')" placeholder="ABC1D23" required />
        <p class="mt-1 text-xs text-gray-400">Formato Mercosul (ABC1D23) ou antigo (ABC1234)</p>
        <x-input-error :messages="$errors->get('plate')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="capacity" value="Capacidade (lugares)" />
        <x-text-input id="capacity" name="capacity" type="number" min="1" max="100" class="mt-1 block w-full"
                       :value="old('capacity', $vehicle->capacity ?? '')" required />
        <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
    </div>
</div>