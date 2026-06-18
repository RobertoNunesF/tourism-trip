<div class="bg-white rounded-xl border border-gray-200">

    {{-- Toolbar: adicionar + busca --}}
    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-100">
        <a href="{{ route('vehicles.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 bg-coinpel text-white text-sm font-medium rounded-md hover:bg-coinpel-dark">
            <x-heroicon-o-plus class="w-4 h-4" />
            Adicionar veículo
        </a>

        <form method="GET" action="{{ route('vehicles.index') }}" class="relative">
            <x-heroicon-o-magnifying-glass class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar veículo"
                   class="pl-9 pr-3 py-2 text-sm rounded-md border-gray-300 focus:border-coinpel focus:ring-coinpel w-56">
        </form>
    </div>

    {{-- Tabela --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="px-5 py-3 font-medium">Placa</th>
                    <th class="px-5 py-3 font-medium">Modelo</th>
                    <th class="px-5 py-3 font-medium">Capacidade</th>
                    <th class="px-5 py-3 font-medium w-10"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $vehicle->plate }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $vehicle->model }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $vehicle->capacity }} lugares</td>
                        <td class="px-5 py-3 text-right">
                            <x-dropdown align="right" width="44">
                                <x-slot name="trigger">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <x-heroicon-o-ellipsis-horizontal class="w-5 h-5" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('vehicles.edit', $vehicle)">
                                        Editar veículo
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}"
                                          onsubmit="return confirm('Tem certeza que deseja excluir este veículo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                            Excluir veículo
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">
                            @if (request('q'))
                                Nenhum veículo encontrado para "{{ request('q') }}".
                            @else
                                Nenhum veículo cadastrado ainda.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($vehicles->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $vehicles->links() }}
        </div>
    @endif
</div>