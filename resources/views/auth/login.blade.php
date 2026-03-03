<x-guest-layout>
    <div class="space-y-6">
        <header class="space-y-2">
            <span class="pill">Acceso</span>
            <h2 class="display-font text-2xl font-bold text-slate-900">Iniciar Sesion</h2>
            <div class="accent-rule"></div>
            <p class="text-sm text-slate-600">Accede a tu cuenta del instituto.</p>
        </header>

        <x-auth-session-status class="status-ok" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="field-stack">
                <x-input-label for="email" :value="__('Correo electronico')" class="text-slate-700" />
                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-sm" />
            </div>

            <div class="field-stack">
                <x-input-label for="password" :value="__('Contrasena')" class="text-slate-700" />
                <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="text-sm" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-sm text-slate-600">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 focus:ring-slate-500" name="remember">
                    <span class="ms-2">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm subtle-link" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contrasena?') }}
                    </a>
                @endif
            </div>

            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Iniciar sesion') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
