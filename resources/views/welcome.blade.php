@extends('plantilla')
@section('content')
    <div class="container-lg"  >
        <div class="col-sm-12 mt-md-2" data-aos="fade-up" data-aos-duration="1000">
            <a href="{{ route('register') }}" >
                <video autoplay loop class="w-100" muted>
                    <source src="{{ asset('img/videos/loop_slide_libros.mp4') }}" type="video/mp4">
                </video>
            </a>
        </div>
        <div style="text-align: justify" data-aos="fade-up" data-aos-duration="1500" >
            <h5 class="text-center fw-bold">¡Bienvenidos a la Biblioteca Pública del Estado de Jalisco!</h5>
            <hr>
            <p>
                Para poder acceder al préstamo externo de libros, el primer paso es registrarte para obtener tu credencial.
                Solo necesitas ingresar a nuestra página de registro y completar los datos solicitados con una
                identificación oficial (INE, pasaporte, cédula profesional expedida por la Secretaría de Educación Pública,
                Cartilla del Servicio Militar Nacional y, en el caso de menores, CURP e identificación escolar) y
                comprobante de domicilio (CFE, cable) no mayor a tres meses de antigüedad desde su fecha de expedición.
            </p>
            <p>
                Pasos para registrarte:
            <ol>
                <li>Llena el formulario de inscripción con tus datos personales.</li>
                <li>Realiza el proceso de validación para obtener tu credencial en nuestras instalaciones facilitando los
                    documentos identificativos.</li>
                <li>Una vez debidamente registrado, podrás acceder a todos nuestros servicios de préstamo de libros.</li>
            </ol>
            Recuerda que esta credencial te permitirá disfrutar de una amplia variedad de títulos de nuestra colección,
            ¡así que no dudes en registrarte hoy mismo!
            Si tienes alguna duda, no dudes en contactarnos. Estamos para ayudarte.
            ¡Nos vemos pronto en la biblioteca!
            </p>


        </div>
        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-primary btn my-2 " target="_blank">¡Regístrate aquí!</a>
        </div>
        {{--
        <div class="container d-flex justify-content-around flex-column flex-md-row mt-4">
            @if (!$servicios->isEmpty())
                <div class="col-ms-12 col-md-5 col-lg-4 mt-3">
                    <h5 class="text-center">Servicios</h5>
                    <hr>
                    <div class="container swiper" style="height: 520px">

                        <div class="slider-wrapper h-100 w-100 m-auto">
                            <div class="card-list swiper-wrapper">
                                @foreach ($servicios as $item)
                                    <div class="card-item swiper-slide">
                                        @php
                                            $url = isset($item->photo)
                                                ? asset('storage/' . $item->photo)
                                                : asset('img/image-default.jpg');
                                        @endphp
                                        <img src="{{ $url }}" alt="User Image" class="user-image">
                                        <h2 class="user-name">{{ $item->nombre }}</h2>
                                        <p class="user-profession">{{ Str::limit($item->descripcion, 100) }}</p>
                                        <a class="message-button p-2 text-decoration-none"
                                            href="{{ route('servicios.show', $item->slug) }}">ver
                                            más</a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-pagination"></div>
                            <div class="swiper-slide-button swiper-button-prev"></div>
                            <div class="swiper-slide-button swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            @endif

            
            @if (!$categorias->isEmpty())
                <div class="col-ms-12 col-md-5 col-lg-4 mt-3">
                    <h5 class="text-center">Categorias</h5>
                    <hr>
                    <div class="container swiper" style="height: 520px">

                        <div class="slider-wrapper h-100 w-100 m-auto">
                            <div class="card-list swiper-wrapper">
                                @foreach ($categorias as $item)
                                    <div class="card-item swiper-slide">
                                        @php
                                            $url = isset($item->photo)
                                                ? asset('storage/' . $item->photo)
                                                : asset('img/image-default.jpg');
                                        @endphp
                                        <img src="{{ $url }}" alt="User Image" class="user-image">
                                        <h2 class="user-name">{{ $item->name }}</h2>
                                        <p class="user-profession">{{ Str::limit($item->descripcion, 100) }}</p>
                                        <button class="message-button">ver más</button>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-pagination"></div>
                            <div class="swiper-slide-button swiper-button-prev"></div>
                            <div class="swiper-slide-button swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            @endif
    </div>
    --}}



    </div>
@endsection
