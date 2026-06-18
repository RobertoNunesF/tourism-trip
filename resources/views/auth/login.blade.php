<x-guest-layout>
    <h2 class="text-base font-semibold text-gray-700 mb-5">Faça login:</h2>

    {{-- Status de sessão (ex: link de reset enviado) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <x-text-input id="email" class="block w-full" type="email" name="email"
                           :value="old('email')" required autofocus autocomplete="username"
                           placeholder="O seu email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Senha --}}
        <div>
            <x-text-input id="password" class="block w-full" type="password" name="password"
                           required autocomplete="current-password" placeholder="Senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Lembrar-me + esqueceu a senha --}}
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember"
                       class="rounded border-gray-300 text-coinpel focus:ring-coinpel">
                <span class="text-gray-600">Lembrar-me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-coinpel hover:underline">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <x-primary-button class="mt-2">
            Entrar
        </x-primary-button>
    </form>
</x-guest-layout>