@extends('auth.plantilla')

@section('title', __('Verify Email Address'))


@section('content')
    <section class="bg-secondary-100 py-3 py-md-5 py-xl-8 w-100">
        <div class="container d-flex h-100 align-items-center justify-content-center">
            <div class="shadow col-sm-12 col-md-8 col-xl-6 card border-0 rounded-4">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="my-2">
                        <img class="img-fluid rounded " loading="lazy" src="{{ asset('img/portada-web.jpg') }}" width="100%"
                            height="250" alt="BootstrapBrain Logo" style="aspect-ratio: 16 / 5;object-fit: cover;">
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-center text-uppercase">Gracias por verificar tu correo</p>
                        <p style="text-align: justify">Ya estas más cerca de poder leer tus libros favoritos desde casa.
                            <br> El siguiente paso es acudir a la Biblioteca por tu credencial </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
