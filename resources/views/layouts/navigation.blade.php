<nav x-data="{ open: false }" class="px-4 pt-4 sm:px-6 lg:px-8">
    <div class="menu-panel max-w-7xl mx-auto px-4 sm:px-5 lg:px-6 py-2 rounded-2xl border border-slate-300/60 bg-white/60 backdrop-blur">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-slate-700" />
                    </a>
                </div>

                <div class="hidden space-x-3 sm:ms-8 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                    <x-dropdown align="right" width="48" contentClasses="p-1 bg-white/95 backdrop-blur">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-semibold rounded-xl text-slate-700 bg-white/90 border border-slate-200 hover:bg-white focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-600 hover:text-slate-800 hover:bg-slate-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="accent-rule mt-1 mb-1"></div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="max-w-7xl mx-auto bg-white/90 backdrop-blur rounded-2xl border border-slate-300/60 shadow-sm pt-2 pb-3 space-y-1 mt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <div class="pt-4 pb-2 border-t border-slate-200/70">
                <div class="px-4">
                <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
