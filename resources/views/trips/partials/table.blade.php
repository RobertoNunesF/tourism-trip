{{--
    resources/views/trips/partials/table.blade.php
    Reaproveitado em index, create e edit.
--}}
<div class="bg-white rounded-xl border border-gray-200">

    {{-- Toolbar: adicionar + busca --}}
    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-100">
        <a href="{{ route('trips.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 bg-coinpel text-white text-sm font-medium rounded-md hover:bg-coinpel-dark">
            <x-heroicon-o-plus class="w-4 h-4" />
            Adicionar viagem
        </a>

        <form method="GET" action="{{ route('trips.index') }}" class="relative">
            <x-heroicon-o-magnifying-glass class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar viagem (origem/destino)"
                   class="pl-9 pr-3 py-2 text-sm rounded-md border-gray-300 focus:border-coinpel focus:ring-coinpel w-64">
        </form>
    </div>

    {{-- Tabela --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="px-5 py-3 font-medium">Rota</th>
                    <th class="px-5 py-3 font-medium">Saída</th>
                    <th class="px-5 py-3 font-medium">Chegada</th>
                    <th class="px-5 py-3 font-medium">Veículo</th>
                    <th class="px-5 py-3 font-medium">Motorista</th>
                    <th class="px-5 py-3 font-medium w-10"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($trips as $trip)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-medium text-gray-800 whitespace-nowrap">
                            {{ $trip->origin }} <span class="text-gray-400">→</span> {{ $trip->destination }}
                        </td>
                        <td class="px-5 py-3 text-gray-600 whitespace-nowrap">
                            {{ $trip->departure_time->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-5 py-3 text-gray-600 whitespace-nowrap">
                            {{ $trip->arrival_time->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-5 py-3 text-gray-600 whitespace-nowrap">
                            {{ $trip->vehicle->plate ?? '—' }}
                        </td>
                        <td class="px-5 py-3 text-gray-600 whitespace-nowrap">
                            {{ $trip->driver->name ?? '—' }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <x-dropdown align="right" width="44">
                                <x-slot name="trigger">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <x-heroicon-o-ellipsis-horizontal class="w-5 h-5" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('trips.edit', $trip)">
                                        Editar viagem
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('trips.destroy', $trip) }}"
                                          onsubmit="return confirm('Tem certeza que deseja cancelar esta viagem?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                            Cancelar viagem
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400">
                            @if (request('q'))
                                Nenhuma viagem encontrada para "{{ request('q') }}".
                            @else
                                Nenhuma viagem cadastrada ainda.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($trips->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $trips->links() }}
        </div>
    @endif
</div>