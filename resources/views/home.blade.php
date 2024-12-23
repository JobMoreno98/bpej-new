@extends('adminlte::page')
@section('title', 'Home')

@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container d-flex flex-wrap align-items-center justify-content-start">
        @foreach ($modulos as $key => $value)
            <div class="col-lg-4 col-sm-12  col-md-8 col-lg-4  my-3" 
            data-aos="zoom-in" 
            data-aos-duration="500">
                <div class="card card-margin h-100">
                    <div class="card-body pt-2">
                        <div class="">
                            <div class="d-flex align-items-center">
                                <div class="d-flex p-2 m-1 rounded-circle"
                                    style="background: {{ $value[0]->modulo_color }}">
                                    <span class="material-symbols-outlined" style="font-size: 24pt;">
                                        {{ $value[0]->modulo_icono }}
                                    </span>
                                </div>
                                <div class="widget-49-meeting-info">
                                    <h5 class="m-0 widget-49-pro-title">
                                        {{ $value[0]->modulo_nombre }}</h5>
                                </div>
                            </div>
                            <div class="mt-3">
                                @foreach ($value as $enlace)
                                    @php
                                        if (Str::contains($enlace->enlace_enlace, '148.202.')) {
                                            $link = $enlace->enlace_enlace;
                                        } else {
                                            $parametros = str_replace(
                                                'user_id',
                                                Auth::user()->id,
                                                $enlace->enlace_parametro,
                                            );
                                            $link = route($enlace->enlace_enlace, $parametros);
                                        }
                                    @endphp
                                    <span><a class="{{ $enlace->enlace_estilo }}" href="{{ $link }}">
                                            {{ $enlace->enlace_titulo }}
                                        </a></span>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('js')
   
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
