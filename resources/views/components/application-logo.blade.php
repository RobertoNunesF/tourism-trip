@props(['class' => 'w-10 h-10'])

<div class="flex items-center gap-2">
    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="{{ $class }}">
        <path d="M24 4a20 20 0 1 1-14.14 5.86" stroke="#F0871D" stroke-width="5" stroke-linecap="round"/>
        <path d="M24 4a20 20 0 1 0 14.14 34.14" stroke="#4B2E83" stroke-width="5" stroke-linecap="round"/>
        <rect x="21.5" y="14" width="5" height="14" rx="2.5" fill="#4B2E83"/>
    </svg>
    <span class="text-xl font-bold tracking-tight text-coinpel-dark">COINPEL</span>
</div>