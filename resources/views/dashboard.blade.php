<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="display-font font-extrabold text-2xl text-slate-900 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="accent-rule mt-2"></div>
        </div>
    </x-slot>

    <section class="page-wrap">
        <div class="content-shell">
            <div class="section-card">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Panel de control</p>
                        <h3 class="display-font text-xl font-bold text-slate-900">{{ __("Ya has iniciado sesion.") }}</h3>
                    </div>
                    <span class="pill">Activo</span>
                </div>
                <p class="mt-4 text-slate-600">
                    Gestiona tu perfil, revisa contenidos y navega por el sistema desde una experiencia unificada.
                </p>
            </div>
        </div>
    </section>
</x-app-layout>
