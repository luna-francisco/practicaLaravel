<header class="h-header bg-header flex flex-row justify-between items-center p-3">

    <img class="max-h-full" src="{{asset("/images/logo.png")}}" alt="logo">

    <h1 class="titulo-moderno">Gestion de Instituto</h1>

    @guest()
    <div class="space-x-2">
        <a href="login"><button class="btn btn-sm btn-primary">Iniciar</button></a>
        <a href="register"><button class="btn btn-sm btn-primary">Registrarse</button></a>
    </div>
    @endguest

    @auth

        {{auth()->user()->name}}
        <form action="{{route("logout")}}" method="POST">

            @csrf
            <button class="btn btn-sm btn-primary">Salir</button>
        </form>
    @endauth


</header>

