<x-app-layout>
    <x-slot name="header">Veículos</x-slot>

    @include('vehicles.partials.table', ['vehicles' => $vehicles])
</x-app-layout>