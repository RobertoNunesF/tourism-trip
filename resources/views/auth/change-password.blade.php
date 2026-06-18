<x-guest-layout>
    <h2 class="text-base font-semibold text-gray-700 mb-2">Crie uma nova senha</h2>
    <p class="text-sm text-gray-500 mb-5">
        Este é o seu primeiro acesso. Por segurança, defina uma nova senha pra continuar.
    </p>

    <form method="POST" action="{{ route('password.update-first') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="password" value="Nova senha" />
            <x-text-input id="password" name="password" type="password" class="block w-full mt-1"
                          required autofocus autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Repetir senha" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="block w-full mt-1" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="mt-2">
            Continuar
        </x-primary-button>
    </form>
</x-guest-layout>