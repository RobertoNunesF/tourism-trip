<x-app-layout>
    <x-slot name="header">Motoristas</x-slot>

    <div class="flex flex-col lg:flex-row gap-6 items-start">

        <div class="flex-1 min-w-0 w-full">
            @include('drivers.partials.table', ['drivers' => $drivers])
        </div>

        <aside class="w-full lg:w-96 flex-shrink-0 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Motorista</h3>
                <a href="{{ route('drivers.index') }}" class="text-gray-400 hover:text-gray-600">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </a>
            </div>

            <form method="POST" action="{{ route('drivers.store') }}" class="p-5 space-y-5">
                @csrf

                @include('drivers.partials.form')

                <div class="flex flex-col gap-2 pt-2">
                    <x-primary-button>Finalizar cadastro</x-primary-button>
                    <a href="{{ route('drivers.index') }}"
                       class="w-full text-center py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </aside>
    </div>
</x-app-layout>