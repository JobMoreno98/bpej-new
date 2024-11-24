@extends('auth.plantilla')

@section('title', __('Register'))


@section('content')
    {{--
    <section class=" py-2 py-md-5 py-xl-8 w-100" data-bs-theme="secondary">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center justify-content-center m-1 p-1 p-md-5 rounded ">
                <div class="col-12 col-md-8 col-xl-5 m-0 border rounded-4 border-dark p-1 p-md-3">
                    <div>
                        <img class="img-fluid rounded rounded-4" loading="lazy" src="{{ asset('img/portada-web.jpg') }}" width="100%"
                            height="250" alt="BootstrapBrain Logo" style="aspect-ratio: 16 / 5;object-fit: cover;">
                    </div>
                    <div class="card border-0 rounded-4" style="border:#7c2422 solid 2px;">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3>{{ __('Register') }}</h3>
                                        <p><a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @method('POST')
                                @csrf
                                <div>
                                    <x-label for="name" value="{{ __('Name') }}" />
                                    <input class="form-control" id="name" class="block mt-1 w-full" type="text"
                                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <input class="form-control" id="email" class="block mt-1 w-full" type="email"
                                        name="email" :value="old('email')" required autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <input class="form-control" id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <input class="form-control" id="password_confirmation" class="block mt-1 w-full"
                                        type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-check my-3">
                                        <input class="form-check-input" type="checkbox" value="" name="terms"
                                            id="terms" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </label>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn my-2"
                                            type="submit">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-4">
                                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
--}}
    <section class=" py-2 py-md-5 py-xl-8 w-100" data-bs-theme="secondary">
        <div class="container-fluid d-flex h-100 align-items-center justify-content-center ">
            <div class="col-sm-12 d-flex  align-items-center justify-content-center m-1 p-1 p-md-5 rounded ">
                <div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 m-0 border rounded-4 border-dark p-1 p-md-3">
                    <div class="card border-0 rounded-4" style="border:#7c2422 solid 2px;">
                        <div class="card-body p-0">
                            <div class="p-0 mb-2">
                                <img class="img-fluid rounded rounded-4" loading="lazy"
                                    src="{{ asset('img/portada-web.jpg') }}" width="100%" height="250"
                                    alt="BootstrapBrain Logo" style="aspect-ratio: 16 / 5;object-fit: cover;">
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="col-12">
                                <div class="mb-4">
                                    <h3 class="text-center">{{ __('Register') }}</h3>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register-user') }}" class="px-2"
                                enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="col-sm-12 my-1 ">
                                    <label for="">Mi foto</label>
                                    <input accept="image/jpeg" class="form-control" type="file" name="profile_photo_path"
                                        onchange="loadFile(event)">
                                </div>
                                <div class="col-sm-12 my-1  " id="nombre">
                                    <label for="">Nombre Completo (Favor de iniciar por apellidos)</label>
                                    <input class="form-control" type="text" name="name" value="">
                                </div>
                                <div class="col-sm-12 my-1 " id="email">
                                    <label for="">Correo</label>
                                    <input class="form-control" type="email" name="email" value="">
                                </div>

                                <div class="col-sm-12 my-1 " id="telefono">
                                    <label for="">Teléfono</label>
                                    <input class="form-control" type="text" name="telefono" value="">
                                </div>

                                <div class="d-flex align-items-center col-sm-12 my-1 justify-content-evenly">
                                    <label for="">Eres *</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id=""
                                            id="yes" onclick="option(1)" id="inlineRadio1" value="adulto">

                                        <label class="form-check-label" for="inlineRadio1">Adulto</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="not"
                                            onclick="option(0)" id="inlineRadio2" value="menor">
                                        <label class="form-check-label" for="inlineRadio2">Menor</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-1 d-none " id="tutor">
                                    <label for="">Tutor</label>
                                    <input class="form-control" type="text" name="tutor" value="">
                                </div>

                                <div class=" col-sm-12 my-1 my-1 ">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input class="form-control" type="date" name="fecha_nacimiento" value=""
                                        id="">
                                </div>
                                <div class="col-sm-12 my-1 ">
                                    <label for="">Calle y número</label>
                                    <input class="form-control" type="text" name="calle" value="" id="">

                                </div>

                                <div class="col-sm-12 my-1 ">
                                    <label for="">Colonia</label>
                                    <input class="form-control" type="text" name="colonia" value=""
                                        id="colonia">

                                </div>

                                <div class="col-sm-12 my-1 ">
                                    <label for="">Municipio</label>
                                    <input class="form-control" type="text" name="municipio" value=""
                                        id="">
                                </div>
                                <div class=" col-sm-12 my-1 ">
                                    <label for="">Código Postal</label>
                                    <input class="form-control" type="text" name="codigo_postal" value=""
                                        id="">
                                </div>
                                <div class=" col-sm-12 my-1 ">
                                    <label for="">Estado</label>
                                    <input class="form-control" type="text" name="estado" value=""
                                        id="">
                                </div>
                                <div class="col-sm-12 my-1 ">
                                    <label for="">Comprobante de Domicilio</label>
                                    <input accept="image/heic,image/jpg,image/jpeg,application/pdf" class="form-control"
                                        type="file" name="documento" id="">
                                </div>
                                <div class="col-sm-12 my-1 ">
                                    <label for="">Identificación</label>
                                    <input accept="image/heic,image/jpg,image/jpeg,application/pdf" class="form-control"
                                        type="file" name="identificacion" id="">
                                </div>
                                <div
                                    class="col-sm-12 my-1 form-check form-check-inline my-1 d-flex flex-wrap justify-content-center">
                                    <input class="form-check-input" type="radio" name="terminos" id="terminos"
                                        required value="1">
                                    <label class="form-check-label text-uppercase mx-1" for="terminos">Leí y acepto el
                                        aviso de privacidad
                                        *</label>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn my-2 text-uppercase "
                                            type="submit">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary text-center" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            AVISO DE PRIVACIDAD
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">AVISO DE PRIVACIDAD</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="text-align:justify;">
                                        La Universidad de Guadalajara (en adelante UdeG), con domicilio en Avenida Juárez
                                        976, colonia Centro, código postal 44100, en Guadalajara, Jalisco, hace de su
                                        conocimiento que se considerará como información confidencial aquella que se
                                        encuentre contemplada en los artículos 3, fracciones IX y X de la LPDPPSOEJM; 21 de
                                        la LTAIPEJM; Lineamientos Cuadragésimo Octavo y Cuadragésimo Noveno de los
                                        Lineamientos de Clasificación; Lineamientos Décimo Sexto, Décimo Séptimo y
                                        Quincuagésimo Octavo de los Lineamientos de Protección, así como aquellos datos de
                                        una persona física identificada o identificable y la inherente a las personas
                                        jurídicas, los cuales podrán ser sometidos a tratamiento y serán única y
                                        exclusivamente utilizados para los fines que fueron proporcionados, de acuerdo con
                                        las finalidades y atribuciones establecidas en los artículos 1, 5 y 6 de la Ley
                                        Orgánica, así como 2 y 3 del Estatuto General, ambas legislaciones de la UdeG, de
                                        igual forma, para la prestación de los servicios que la misma ofrece conforme a las
                                        facultades y prerrogativas de la entidad universitaria correspondiente y estarán a
                                        resguardo y protección de la misma.

                                        Usted puede consultar nuestro Aviso de Privacidad integral en la siguiente página
                                        web: <a target="_blank"
                                            href="http://www.transparencia.udg.mx/aviso-confidencialidad-integral">ver</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

@endsection

@section('js')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true
        });
    </script>
@endsection
