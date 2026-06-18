<x-app-layout>
    <x-slot name="header">Viagens</x-slot>

    @include('trips.partials.table', ['trips' => $trips])
</x-app-layout>