<nav x-data="{ open: false }" class="bg-nav px-3 py-3 sm:px-4 md:px-6">
    @php
        $baseLink = 'inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold tracking-wide transition-all duration-200';
        $activeLink = 'bg-white text-blue-700 shadow-sm';
        $idleLink = 'text-white/90 hover:text-white hover:bg-white/15';
    @endphp

    <div class="mx-auto w-full max-w-7xl rounded-2xl bg-white/10 p-2 backdrop-blur-sm ring-1 ring-white/20">
        <div class="flex items-center justify-between md:hidden">
            <span class="text-white/95 font-semibold text-sm">Menu</span>
            <button
                type="button"
                class="btn btn-sm border-white/70 bg-transparent text-white hover:bg-white/15"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="main-navigation-links"
            >
                <span x-show="!open">MENU</span>
                <span x-show="open">CERRAR</span>
            </button>
        </div>

        <div
            id="main-navigation-links"
            class="mt-2 hidden flex-col gap-2 md:mt-0 md:flex md:flex-row md:flex-wrap md:items-center md:justify-center md:gap-2 lg:gap-3"
            :class="{ 'hidden': !open, 'flex': open }"
        >
            <a
                href="/about"
                class="{{ $baseLink }} {{ request()->is('about*') ? $activeLink : $idleLink }}"
                @click="open = false"
            >About</a>
            <a
                href="/noticias"
                class="{{ $baseLink }} {{ request()->is('noticias*') ? $activeLink : $idleLink }}"
                @click="open = false"
            >Noticias</a>
            <a
                href="/alumnos"
                class="{{ $baseLink }} {{ request()->is('alumnos*') ? $activeLink : $idleLink }}"
                @click="open = false"
            >Alumnos</a>
        </div>
    </div>
</nav>
