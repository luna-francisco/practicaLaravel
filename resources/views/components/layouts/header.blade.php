<header class="bg-header px-3 py-3 sm:px-4 md:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-7xl rounded-2xl bg-white p-3 sm:p-4 shadow-md ring-1 ring-slate-200">
        <div class="flex flex-col gap-3 md:gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center justify-center lg:justify-start gap-3 md:gap-4 min-w-0">
                <img class="h-10 w-auto sm:h-12 md:h-14 lg:h-16 shrink-0 rounded-md" src="{{ asset('/images/logo.png') }}" alt="logo">
                <div class="min-w-0">
                    <p class="text-slate-500 text-xs sm:text-sm font-medium tracking-widest uppercase">Instituto</p>
                    <h1 class="text-slate-900 font-extrabold leading-tight text-xl sm:text-2xl md:text-3xl lg:text-4xl text-center lg:text-left truncate">
                        <a href="{{ route('main') }}" class="hover:text-blue-700 transition-colors duration-200">Gestion de Instituto</a>
                    </h1>
                </div>
            </div>

            @guest()
                <div class="w-full lg:w-auto flex flex-col sm:flex-row md:justify-center lg:justify-end gap-2 md:gap-3">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto md:min-w-[10rem] lg:min-w-0">
                        <button class="btn btn-sm md:btn-md w-full border-0 bg-blue-600 text-white hover:bg-blue-700 sm:w-auto">Iniciar</button>
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto md:min-w-[10rem] lg:min-w-0">
                        <button class="btn btn-sm md:btn-md w-full border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 sm:w-auto">Registrarse</button>
                    </a>
                </div>
            @endguest

            @auth
                <div class="w-full lg:w-auto flex flex-col sm:flex-row items-start sm:items-center md:justify-center lg:justify-end gap-2 md:gap-3">
                    <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-2 text-slate-700 font-semibold text-sm sm:text-base">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto md:min-w-[10rem] lg:min-w-0">
                        @csrf
                        <button class="btn btn-sm md:btn-md w-full border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 sm:w-auto">Salir</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>
