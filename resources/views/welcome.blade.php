<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME', 'LARAVEL') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/slide.css') }}">
</head>

<body class="antialiased">
    <nav class="navbar navbar-dark" style="background:#7c2422;">
        <div class="container justify-content-center justify-content-md-between">
            <a class="navbar-brand d-flex align-items-center flex-column flex-md-row flex-wrap" href="#">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="mx-1" width="100"
                    class="d-inline-block align-text-top">
                <p class="text-wrap m-0 text-center">
                    {{ env('APP_NAME', 'LARAVEL') }}
                </p>

                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold ">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-decoration-none text-white btn btn-sm">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-decoration-none text-white btn btn-sm">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </a>
        </div>
    </nav>
    <div class="w-100 text-white" style="background:#ca580d">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Categorias Literarias</a>
            </li>
        </ul>
    </div>
    <div class="container-lg">
        <div class="col-sm-12">
            <video autoplay loop class="w-100" muted>
                <source src="{{ asset('img/videos/loop_bpej_agua.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div style="text-align: justify">
            <h5 class="text-center fw-bold">Acerca de</h5>
            <hr>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, in sequi, accusantium dolore aperiam
            deleniti voluptatibus illum quidem nobis similique non! Officia pariatur accusantium repudiandae, dolorem
            molestias ab explicabo labore?
            Esse, ab. Ratione sapiente soluta nobis totam natus, fuga voluptatum explicabo cumque ipsam culpa, enim,
            possimus iste sint tempore aut. Laborum asperiores et ducimus aliquam dolores corrupti quae, libero maiores?
            Repellendus libero id laborum, ut excepturi quo non. Nisi, quod adipisci. Dignissimos, molestiae incidunt
            alias, nulla, at eveniet repellat delectus culpa quae voluptas quo. Laboriosam quis corporis illo earum eum!
        </div>
        <div class="container d-flex justify-content-around flex-column flex-md-row mt-4">
            <div class="col-ms-12 col-md-5 col-lg-4">
                <h5 class="text-center">Servicios</h5>
                <hr>
                <div class="container swiper">

                    <div class="slider-wrapper w-100 m-auto">
                        <div class="card-list swiper-wrapper">
                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Servicio 1</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Servicio 2</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Servicio 3</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Servicio 4</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Servicio 5</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-slide-button swiper-button-prev"></div>
                        <div class="swiper-slide-button swiper-button-next"></div>
                    </div>
                </div>
            </div>


            <div class="col-ms-12 col-md-5 col-lg-4">
                <h5 class="text-center">Categorias</h5>
                <hr>
                <div class="container swiper">

                    <div class="slider-wrapper w-100 m-auto">
                        <div class="card-list swiper-wrapper">
                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Categoria 1</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Categoria 2</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Categoria 3</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Categoria 4</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>

                            <div class="card-item swiper-slide">
                                <img src="https://picsum.photos/200/300" alt="User Image" class="user-image">
                                <h2 class="user-name">Categoria 5</h2>
                                <p class="user-profession">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Beatae tenetur aspernatur sunt nisi repellendus</p>
                                <button class="message-button">ver más</button>
                            </div>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-slide-button swiper-button-prev"></div>
                        <div class="swiper-slide-button swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="mt-5 footer pt-3 text-white" style="background:#7c2422;">
        <div class="container footer-top">
            <div class="row">
                <div class="col-sm-12 footer-about d-flex flex-column flex-md-row flex-wrap"
                    style="align-items: center !important;">
                    <div class="mx-md-2 px-md-2 col-sm-12 col-md-5  m-auto border-sm-bottom border-white py-2 my-2  py-md-0 my-md-0" >
                        <img src="{{ asset('img/udg_pie_logo.svg') }}" alt="" class="d-block">
                        <a href="{{ route('home') }}" class="fs-3 text-decoration-none text-white logo m-auto">
                            <span class="sitename text-uppercase text-center text-sm-center">Biblioteca Pública del
                                Estado de Jalisco "Juan José
                                Arreola"</span>
                        </a>
                    </div>

                    <div
                        class="d-flex col-sm-12 col-md-6  flex-column flex-md-row  align-items-start align-items-md-center ">
                        <div class="mx-md-1 col-sm-12  h-100">
                            <h4>{{ __('Address') }}</h4>
                            <p>Periférico Norte Manuel Gómez Morín no. 1695, Colonia Belenes C.P. 45100
                                Zapopan, Jalisco, México.</p>

                            <h4>{{ __('Contact') }}</h4>
                            <p>
                                <strong>{{ __('Phone') }}:</strong>
                                <span>33 3836 4530</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slide.js') }}"></script>

</body>

</html>
