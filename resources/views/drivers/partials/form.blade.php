@php($driver = $driver ?? null)

<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Nome completo" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                       :value="old('name', $driver->name ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="cnh_number" value="Número da CNH" />
        <x-text-input id="cnh_number" name="cnh_number" type="text" inputmode="numeric" maxlength="11"
                       class="mt-1 block w-full" :value="old('cnh_number', $driver->cnh_number ?? '')" required />
        <p class="mt-1 text-xs text-gray-400">11 dígitos numéricos</p>
        <x-input-error :messages="$errors->get('cnh_number')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone" value="Telefone" />
        <x-text-input id="phone" name="phone" type="text" placeholder="(00) 00000-0000"
                       class="mt-1 block w-full" :value="old('phone', $driver->phone ?? '')" required />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
</div>