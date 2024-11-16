@extends('plantilla')
@section('content')
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
