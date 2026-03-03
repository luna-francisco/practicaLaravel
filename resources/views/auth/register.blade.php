<x-guest-layout>
    <div class="space-y-6">
        <header class="space-y-2">
            <span class="pill">Registro</span>
            <h2 class="display-font text-2xl font-bold text-slate-900">Crear Cuenta</h2>
            <div class="accent-rule"></div>
            <p class="text-sm text-slate-600">Registra un nuevo usuario para acceder al sistema.</p>
        </header>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="field-stack">
                <x-input-label for="name" :value="__('Nombre')" class="text-slate-700" />
                <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="text-sm" />
            </div>

            <div class="field-stack">
                <x-input-label for="email" :value="__('Correo electronico')" class="text-slate-700" />
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-sm" />
            </div>

            <div class="field-stack">
                <x-input-label for="password" :value="__('Contrasena')" class="text-slate-700" />
                <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="text-sm" />
            </div>

            <div class="field-stack">
                <x-input-label for="password_confirmation" :value="__('Confirmar contrasena')" class="text-slate-700" />
                <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm" />
            </div>

            <div class="space-y-3">
                <x-primary-button class="w-full justify-center">
                    {{ __('Registrarse') }}
                </x-primary-button>

                <a class="block text-center text-sm subtle-link" href="{{ route('login') }}">
                    {{ __('Ya tienes cuenta? Inicia sesion') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
