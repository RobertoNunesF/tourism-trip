<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'COINPEL') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">

        {{-- Coluna esquerda: formulário --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-white px-6 sm:px-12">
            <div class="w-full max-w-sm">
                <div class="flex justify-center mb-8">
                    <x-application-logo class="w-12 h-12" />
                </div>

                {{ $slot }}
            </div>
        </div>

        {{-- Coluna direita: ilustração --}}
        <div class="hidden lg:flex w-1/2 bg-coinpel relative overflow-hidden items-end justify-center">
            <svg viewBox="0 0 500 400" class="w-full h-auto opacity-90" xmlns="http://www.w3.org/2000/svg">
                <circle cx="120" cy="90" r="34" fill="#FFFFFF" fill-opacity="0.15"/>
                {{-- skyline simplificado --}}
                <rect x="40"  y="220" width="40" height="140" fill="#FFFFFF" fill-opacity="0.12"/>
                <rect x="90"  y="180" width="55" height="180" fill="#FFFFFF" fill-opacity="0.18"/>
                <rect x="155" y="240" width="35" height="120" fill="#FFFFFF" fill-opacity="0.12"/>
                <rect x="200" y="160" width="60" height="200" fill="#FFFFFF" fill-opacity="0.20"/>
                <rect x="270" y="210" width="45" height="150" fill="#FFFFFF" fill-opacity="0.14"/>
                {{-- montanhas --}}
                <path d="M300 360 L380 250 L460 360 Z" fill="#FFFFFF" fill-opacity="0.10"/>
                <path d="M360 360 L430 270 L500 360 Z" fill="#FFFFFF" fill-opacity="0.10"/>
                {{-- ônibus --}}
                <g transform="translate(150,330)">
                    <rect x="0" y="0" width="160" height="55" rx="8" fill="#FFFFFF" fill-opacity="0.9"/>
                    <rect x="10" y="10" width="30" height="20" rx="2" fill="#4B2E83" fill-opacity="0.6"/>
                    <rect x="48" y="10" width="30" height="20" rx="2" fill="#4B2E83" fill-opacity="0.6"/>
                    <rect x="86" y="10" width="30" height="20" rx="2" fill="#4B2E83" fill-opacity="0.6"/>
                    <circle cx="30" cy="55" r="12" fill="#2E1A4D"/>
                    <circle cx="130" cy="55" r="12" fill="#2E1A4D"/>
                </g>
            </svg>
        </div>
    </div>
</body>
</html>