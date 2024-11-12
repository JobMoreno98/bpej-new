@extends('plantilla')

@section('content')
    <div class="container mt-3">
        <h2 class="text-center">Servicio - <span class="text-uppercase">{{ $servicio->nombre }}</span></h2>
        @php
            $url = isset($servicio->photo) ? asset('storage/' . $servicio->photo) : asset('img/image-default.jpg');
        @endphp
        <div class="d-flex">
            <div class="mx-2">
                <a href="{{ $url }}" class="glightbox" data-width="600px">
                    <img src="{{ $url }}" alt="User Image" class="rounded-3" style="width:250px;">
                </a>
            </div>
            <div>
                <p>
                    <span class="fs-bold fs-4">Ubicación</span> <br>
                    {{ $servicio->ubicacion }}
                </p>
                <p>
                    <span class="fs-bold fs-4">Horario</span> <br>
                    {{ $servicio->horario }}
                </p>
                <p>
                    <span class="fs-bold fs-4">Descripción</span> <br>
                    {{ $servicio->descripcion }}
                </p>
            </div>
        </div>

    </div>
@endsection
