<x-layouts.layout>
    @guest
        <section class="page-wrap">
            <div class="hero-shell py-6 md:py-10">
                <div class="grid gap-6 lg:grid-cols-[1.1fr_1fr] lg:items-center">
                    <div>
                        <span class="pill mb-4">Inicio</span>
                        <h1 class="display-font text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-slate-900 max-w-4xl">Gestion de Instituto</h1>
                        <div class="accent-rule mt-4"></div>
                        <p class="mt-4 text-slate-600 max-w-3xl">Acceso web control de instituto</p>
                        <div class="mt-6 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('register') }}" class="btn-brand font-semibold">Crear cuenta</a>
                            <a href="{{ route('login') }}" class="btn-ghost-light font-semibold">Inicio</a>
                        </div>
                    </div>
                    <div class="hero-media">
                        <img src="{{ asset('images/hero-wave.jpg') }}" alt="Visual institucional" loading="lazy" decoding="async" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </section>
    @endguest

    @auth
        <section class="page-wrap">
            @php
                $cards = [
                    [1, 'Gestion de Proyectos', 'CRUD completo de proyectos.', 'images/card-1.svg'],
                    [2, 'Gestion de Estudiantes', 'CRUD completo de estudiantes.', 'images/estudiantes.jpg'],
                    [3, 'Gestion de Profesores', 'CRUD completo de profesores.', 'images/profesores.jpg'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 sm:gap-6">
                @foreach ($cards as [$id, $title, $description, $image])
                    <article class="feature-card">
                        <div class="feature-media">
                            <img src="{{ asset($image) }}" loading="lazy" decoding="async" alt="{{ $title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-2 p-4 sm:p-5">
                            <span class="card-tag">Contenido</span>
                            <h2 class="display-font text-xl font-bold text-slate-900">{{ $title }}</h2>
                            <p class="text-slate-600">{{ $description }}</p>
                            <a href="{{ route('tarjeta.show', $id) }}" class="btn-brand">Acceder</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endauth
</x-layouts.layout>
