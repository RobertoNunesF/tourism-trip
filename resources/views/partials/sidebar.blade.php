@php
    $menu = [
        ['label' => 'Clientes',     'route' => '#',     'icon' => 'users'],
        ['label' => 'Motoristas',   'route' => 'drivers.index',      'icon' => 'identification'],
        ['label' => 'Estatísticas', 'route' => '#', 'icon' => 'chart-bar'],
        ['label' => 'Veículos',     'route' => 'vehicles.index',     'icon' => 'truck'],
        ['label' => 'Viagens',      'route' => 'trips.index',        'icon' => 'map'],
        ['label' => 'Contratos',    'route' => '#',    'icon' => 'document-text'],
        ['label' => 'Pacotes',      'route' => '#',      'icon' => 'archive-box'],
    ];
@endphp

<aside
    class="fixed md:static inset-y-0 left-0 z-40 w-56 bg-coinpel text-white flex-shrink-0 flex flex-col
           transform transition-transform duration-200 ease-in-out md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="h-20 flex items-center justify-between px-4 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8">
                <path d="M24 4a20 20 0 1 1-14.14 5.86" stroke="#F0871D" stroke-width="5" stroke-linecap="round"/>
                <path d="M24 4a20 20 0 1 0 14.14 34.14" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round"/>
                <rect x="21.5" y="14" width="5" height="14" rx="2.5" fill="#FFFFFF"/>
            </svg>
            <span class="font-bold tracking-tight">COINPEL</span>
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @foreach ($menu as $item)
            @php $active = Route::has($item['route']) && request()->routeIs($item['route'].'*'); @endphp
            <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
               @click="sidebarOpen = false"
               class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition
                      {{ $active ? 'bg-white text-coinpel-dark' : 'text-white/85 hover:bg-white/10' }}">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5 flex-shrink-0" />
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>