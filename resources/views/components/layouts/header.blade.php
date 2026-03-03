<header>
    <div class="mx-auto w-full max-w-7xl px-4 pt-4 pb-3 sm:px-6 sm:pt-5 sm:pb-3">
        <div class="grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center">
            <div class="flex items-start gap-4">
                <img class="h-12 w-auto sm:h-14 md:h-16 shrink-0" src="{{ asset('/images/logo.png') }}" alt="logo">
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm font-semibold tracking-[0.18em] uppercase text-slate-500">Instituto</p>
                    <h1 class="display-font text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight text-slate-900 truncate">
                        <a href="{{ route('main') }}" class="hover:text-slate-700">Gestion de Instituto</a>
                    </h1>

                </div>
            </div>

            @guest
                <div class="flex flex-col sm:flex-row gap-2 lg:justify-end">
                    <a href="{{ route('login') }}"><button class="btn-brand btn w-full sm:w-auto font-semibold">Iniciar</button></a>
                    <a href="{{ route('register') }}"><button class="btn-ghost-light btn w-full sm:w-auto font-semibold">Registrarse</button></a>
                </div>
            @endguest

            @auth
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button
                        type="button"
                        @click="open = !open"
                        class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700"
                    >
                        {{ auth()->user()->name }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 z-50 mt-2 w-40 rounded-xl border border-slate-200 bg-white p-2 shadow-lg"
                        style="display: none;"
                    >
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-ghost-light btn w-full font-semibold text-left">Salir</button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</header>
