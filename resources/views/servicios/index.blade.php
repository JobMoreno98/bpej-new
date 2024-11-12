@extends('plantilla')

@section('css')
    <style>
        .message-button:hover {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #000;
            color: #000;
        }

        .message-button {
            font-size: 8pt;
            padding: 10px 35px;
            color: #030728;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            background: #000;
            color: #fff;
            border: 1px solid transparent;
            transition: 0.2s ease;
            text-transform: uppercase
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <h2 class="text-center">Servicios</h2>
        <div class="card-list d-flex flex-wrap">
            @foreach ($servicios as $item)
                <div
                    class="border border-secondary rounded-3 p-2 col-md-12 m-1 d-flex flex-column w-100 align-items-center flex-md-row justify-content-start">
                    @php
                        $url = isset($item->photo) ? asset('storage/' . $item->photo) : asset('img/image-default.jpg');
                    @endphp
                    <div class="mx-2"><img src="{{ $url }}" alt="User Image" class="rounded-3"
                            style="aspect-ratio:1/1;width:150px;object-fit: cover;"></div>
                    <div class="w-100">
                        <div class="mt-2">
                            <h2 class="text-center text-md-start border-bottom py-2 my-2 text-uppercase">{{ $item->nombre }}
                            </h2>
                            <p class="text-justify">{{ Str::limit($item->descripcion, 250) }}</p>
                        </div>
                        <div class="text-end">
                            <a class="message-button p-2 text-decoration-none"
                                href="{{ route('servicios.show', $item->slug) }}">ver
                                más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
