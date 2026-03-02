<x-layouts.layout>
    @guest
    <div
        class="hero min-h-[calc(100vh-var(--height-header)-var(--height-nav)-var(--height-footer))]"
        style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);"
    >
        <div class="hero-overlay"></div>
        <div class="hero-content text-neutral-content text-center px-3">
            <div class="max-w-md">
                <h1 class="mb-5 text-3xl sm:text-4xl md:text-5xl font-bold">Inicio pagina principal</h1>
                <p class="mb-5">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <p class="mb-5">
                    Usuario conectado {{$nombre}}
                    <h2>Numero generado {{$numero}}</h2>
                </p><br>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>
    @endguest
    @auth
            <section class="page-wrap">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://content.clara.es/medio/2022/06/03/frases-libros-pensar_76779bbf_1280x720.jpg"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('tarjeta.show', 1) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://www.dzoom.org.es/wp-content/uploads/2017/07/seebensee-2384369-810x540.jpg"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta 2</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('tarjeta.show', 2) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCM6Ffo7JBxFDtSq9h5BS8xed9f-dwOVcyvg&s"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta 3</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('tarjeta.show', 3) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKODxaZQ3rrctW543O4QAGZdpuovGxBfeceA&s"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta 4</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('tarjeta.show', 4) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://catedraldezaragoza.es/wp-content/uploads/Torre-Ascensor-Basilica-Pilar-Zaragoza-1.jpg"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta 5</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">

                        <a href="{{ route('tarjeta.show', 5) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 image-full w-full min-h-[18rem] sm:min-h-[20rem] shadow-md">
                <figure>
                    <img
                        src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2018/07/aziz-acharki-549137-unsplash-1200x775.jpg"
                        alt="Shoes" />
                </figure>
                <div class="card-body p-4 sm:p-5">
                    <h2 class="card-title">Ejemplo de tarjeta 6</h2>
                    <p>Descripcion introductoria del contenido de la tarjeta</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('tarjeta.show', 6) }}" class="btn btn-primary">
                            Acceder
                        </a>
                    </div>
                </div>
            </div>


                </div>
            </section>

    @endauth
</x-layouts.layout>
