{{--
    resources/views/users/partials/form.blade.php
    Reaproveitado em create.blade.php e edit.blade.php.
    Espera receber $user (null no create, instância no edit).
--}}
@php($user = $user ?? null)

<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Nome completo" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                       :value="old('name', $user->name ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" value="E-mail" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                       :value="old('email', $user->email ?? '')" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="$user ? 'Nova senha' : 'Senha inicial'" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                       autocomplete="new-password" :required="! $user" />
        <p class="mt-1 text-xs text-gray-400">
            @if ($user)
                Deixe em branco pra manter a senha atual. Se preencher, o usuário precisará trocá-la no próximo login.
            @else
                Mínimo de 8 caracteres. O usuário será obrigado a trocá-la no primeiro acesso.
            @endif
        </p>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
</div>