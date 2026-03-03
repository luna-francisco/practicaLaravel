<nav x-data="{ open: false }">
    @php
        $baseLink = 'nav-text-link';
        $activeLink = 'nav-text-link-active';
        $idleLink = '';
    @endphp

    <div class="mx-auto w-full max-w-7xl px-4 pb-3 pt-1 sm:px-6 sm:pb-4 sm:pt-1">
        <div class="flex items-center justify-between md:hidden">
            <span class="text-sm font-semibold text-slate-500 tracking-wide">Menu</span>
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-700 hover:bg-slate-100" @click="open = !open" :aria-expanded="open.toString()" aria-controls="main-navigation-links">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6l-12 12" /></svg>
            </button>
        </div>

        <div id="main-navigation-links" class="mt-2 hidden flex-col gap-1 md:mt-0 md:flex md:flex-row md:items-center md:justify-start md:gap-6" :class="{ 'hidden': !open, 'flex': open }">
            <a href="/about" class="{{ $baseLink }} {{ request()->is('about*') ? $activeLink : $idleLink }}" @click="open = false">About</a>
            <a href="/noticias" class="{{ $baseLink }} {{ request()->is('noticias*') ? $activeLink : $idleLink }}" @click="open = false">Noticias</a>
            <a href="/alumnos" class="{{ $baseLink }} {{ request()->is('alumnos*') ? $activeLink : $idleLink }}" @click="open = false">Alumnos</a>
        </div>
    </div>
</nav>
