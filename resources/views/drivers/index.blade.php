<x-app-layout>
    <x-slot name="header">Motoristas</x-slot>

    @include('drivers.partials.table', ['drivers' => $drivers])
</x-app-layout>