<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/glightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    @yield('css')
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark" style="background:#7c2422;">
        <div class="container justify-content-center justify-content-md-between">
            <a class="navbar-brand d-flex align-items-center flex-column flex-md-row flex-wrap" href="#">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="mx-1" width="100"
                    class="d-inline-block align-text-top">
                <p class="text-wrap m-0 text-center">
                    {{ env('APP_NAME', 'LARAVEL') }}
                </p>

                {{--
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-decoration-none text-white btn btn-sm">Dashboard</a>
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
                --}}
                <a href="{{ route('register') }}"
                class="ml-4 font-semibold text-decoration-none text-white btn btn-sm">{{ __('Register') }}</a>
            </a>
        </div>
    </nav>
    {{--
    <div class="w-100 text-white" style="background:#ca580d">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('servicios.inicio') }}">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('categorias.inicio') }}">Categorias Literarias</a>
            </li>
        </ul>
    </div>
--}}
    @yield('content')


    <div id="footer">
        <footer class="mt-5 footer pt-3 text-white" style="background:#7c2422;">
            <div class="container footer-top">
                <div class="row">
                    <div class="col-sm-12 footer-about d-flex align-items-center flex-column flex-md-row flex-wrap">
                        <div
                            class="mx-md-2 px-md-2 col-sm-12 col-md-5  m-auto border-sm-bottom border-white py-2 my-2  py-md-0 my-md-0">
                            <img src="{{ asset('img/udg_pie_logo.svg') }}" alt="" class="mx-auto  d-block">
                            <a href="{{ route('home') }}" class="fs-5 text-decoration-none text-white logo m-auto">
                                <span
                                    class=" sitename  d-block  text-center text-sm-center">{{ env('APP_NAME', 'LARAVEL') }}</span>
                            </a>
                        </div>

                        <div
                            class="d-flex col-sm-12 col-md-6  flex-column flex-md-row  align-items-start align-items-md-center ">
                            <div class="mx-md-1 col-sm-12  h-100">
                                <h6 class="m-0">{{ __('Address') }}</h6>
                                <p class="m-0">Periférico Norte Manuel Gómez Morín no. 1695, Colonia Belenes C.P.
                                    45100
                                    Zapopan, Jalisco, México.</p>

                                <h6 class="m-0">{{ __('Contact') }}</h6>
                                <p class="m-0">
                                    {{ __('Phone') }}:
                                    <span>33 3836 4530</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </footer>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{--
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="{{ asset('js/slide.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <script>
        const glightbox = GLightbox({
            selector: '.glightbox',
            openEffect: 'fade',
            closeEffect: 'fade',
            cssEfects: {
                // This are some of the animations included, no need to overwrite
                fade: {
                    in: 'fadeIn',
                    out: 'fadeOut'
                },
                zoom: {
                    in: 'zoomIn',
                    out: 'zoomOut'
                }
            }
        });
    </script>
--}}
    @yield('js')
</body>

</html>
