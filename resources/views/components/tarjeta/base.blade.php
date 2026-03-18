<x-layouts.layout>
    <section class="page-wrap">
        <article class="page-card space-y-4">
            <header class="space-y-2">
                <p class="text-sm uppercase tracking-wide text-slate-500">Modulo de tarjeta</p>
                <h1 class="page-title">{{ $title }}</h1>
                <p class="page-subtitle">{{ $subtitle }}</p>
            </header>

            <div class="rounded-xl border border-slate-200 p-4 sm:p-6 bg-white">
                {{ $slot }}
            </div>

            <a href="{{ route('main') }}" class="btn-ghost-light inline-flex">Volver al inicio</a>
        </article>
    </section>
</x-layouts.layout>
