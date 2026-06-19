<x-app-layout>
    <x-slot name="header">Usuários</x-slot>

    @include('users.partials.table', ['users' => $users])
</x-app-layout>