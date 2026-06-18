<div class="bg-white rounded-xl border border-gray-200">

    {{-- Toolbar: adicionar + busca --}}
    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-100">
        <a href="{{ route('drivers.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 bg-coinpel text-white text-sm font-medium rounded-md hover:bg-coinpel-dark">
            <x-heroicon-o-plus class="w-4 h-4" />
            Adicionar motorista
        </a>

        <form method="GET" action="{{ route('drivers.index') }}" class="relative">
            <x-heroicon-o-magnifying-glass class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar motorista"
                   class="pl-9 pr-3 py-2 text-sm rounded-md border-gray-300 focus:border-coinpel focus:ring-coinpel w-56">
        </form>
    </div>

    {{-- Tabela --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="px-5 py-3 font-medium">Nome</th>
                    <th class="px-5 py-3 font-medium">CNH</th>
                    <th class="px-5 py-3 font-medium">Telefone</th>
                    <th class="px-5 py-3 font-medium w-10"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($drivers as $driver)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-coinpel-50 text-coinpel-dark flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                    {{ Str::of($driver->name)->substr(0, 1)->upper() }}
                                </div>
                                <span class="font-medium text-gray-800">{{ $driver->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $driver->cnh_number }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $driver->phone }}</td>
                        <td class="px-5 py-3 text-right">
                            <x-dropdown align="right" width="44">
                                <x-slot name="trigger">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <x-heroicon-o-ellipsis-horizontal class="w-5 h-5" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('drivers.edit', $driver)">
                                        Editar motorista
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('drivers.destroy', $driver) }}"
                                          onsubmit="return confirm('Tem certeza que deseja excluir este motorista?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                            Excluir motorista
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
                                Nenhum motorista encontrado para "{{ request('q') }}".
                            @else
                                Nenhum motorista cadastrado ainda.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($drivers->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $drivers->links() }}
        </div>
    @endif
</div>