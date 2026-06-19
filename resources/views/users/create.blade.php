<x-app-layout>
    <x-slot name="header">Usuários</x-slot>

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        <div class="flex-1 min-w-0 w-full">
            @include('users.partials.table', ['users' => $users])
        </div>

        <aside class="w-full lg:w-96 flex-shrink-0 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Usuário</h3>
                <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-600">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </a>
            </div>

            <form method="POST" action="{{ route('users.store') }}" class="p-5 space-y-5">
                @csrf

                @include('users.partials.form')

                <div class="flex flex-col gap-2 pt-2">
                    <x-primary-button>Finalizar cadastro</x-primary-button>
                    <a href="{{ route('users.index') }}"
                       class="w-full text-center py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </aside>
    </div>
</x-app-layout>