<div class="bg-white rounded-xl border border-gray-200">

    {{-- Toolbar: adicionar + busca --}}
    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-100">
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 bg-coinpel text-white text-sm font-medium rounded-md hover:bg-coinpel-dark">
            <x-heroicon-o-plus class="w-4 h-4" />
            Adicionar usuário
        </a>

        <form method="GET" action="{{ route('users.index') }}" class="relative">
            <x-heroicon-o-magnifying-glass class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar usuário"
                   class="pl-9 pr-3 py-2 text-sm rounded-md border-gray-300 focus:border-coinpel focus:ring-coinpel w-56">
        </form>
    </div>

    {{-- Tabela --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="px-5 py-3 font-medium">Usuário</th>
                    <th class="px-5 py-3 font-medium">E-mail</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium w-10"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-coinpel-50 text-coinpel-dark flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                    {{ Str::of($user->name)->substr(0, 1)->upper() }}
                                </div>
                                <span class="font-medium text-gray-800">
                                    {{ $user->name }}
                                    @if ($user->id === auth()->id())
                                        <span class="text-xs text-gray-400">(você)</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="px-5 py-3">
                            @if ($user->must_change_password)
                                <span class="inline-flex px-2 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-medium">
                                    Aguardando 1º acesso
                                </span>
                            @else
                                <span class="inline-flex px-2 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">
                                    Ativo
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <x-dropdown align="right" width="44">
                                <x-slot name="trigger">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <x-heroicon-o-ellipsis-horizontal class="w-5 h-5" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('users.edit', $user)">
                                        Editar usuário
                                    </x-dropdown-link>
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('users.destroy', $user) }}"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                                Excluir usuário
                                            </button>
                                        </form>
                                    @endif
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">
                            @if (request('q'))
                                Nenhum usuário encontrado para "{{ request('q') }}".
                            @else
                                Nenhum usuário cadastrado ainda.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    @endif
</div>