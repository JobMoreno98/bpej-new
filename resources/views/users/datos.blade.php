@extends('adminlte::page')
@section('title', 'Mi información')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

@endsection
@section('content_header')
    <h2 class="text-center text-uppercase">Mi Perfil</h2>
@endsection

@section('content')
    <div class="container justify-content-center d-flex">
        <form action="{{ route('update-user', Auth::user()->id) }}"
            class="d-flex flex-wrap flex-column  col-sm-12 my-1 col-md-8" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-center">

                <div class="col-md-6 d-flex justify-content-center flex-column align-items-center">

                    <div id="my_camera" class="w-100"></div>

                    <input type=button value="Tomar foto" class="d-none d-md-block my-2 col-sm-12 col-md-3 btn btn-outline-dark btn-sm"
                        onClick="take_snapshot()">

                    <input type="hidden" name="image" class="image-tag">

                    <input type="hidden" name="x1" value="" />
                    <input type="hidden" name="y1" value="" />
                    <input type="hidden" name="w" value="" />
                    <input type="hidden" name="h" value="" />
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div id="results"></div>
                </div>
            </div>

            <div class="col-sm-12 my-1  " id="nombre">
                <label for="">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="{{ $user->name }}">
            </div>
            <div class="col-sm-12 my-1 " id="email">
                <label for="">Correo</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="d-flex align-items-center col-sm-12 my-1 justify-content-evenly">
                <label for="">Eres *</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="" id="yes"
                        onclick="option(1)" id="inlineRadio1" value="adulto" checked>

                    <label class="form-check-label" for="inlineRadio1">Adulto</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="not" onclick="option(0)"
                        id="inlineRadio2" value="menor">
                    <label class="form-check-label" for="inlineRadio2">Menor</label>
                </div>
            </div>
            <div class="col-sm-12 my-1  d-none" id="tutor">
                <label for="">Tutor</label>
                <input class="form-control" type="text" name="tutor">
            </div>

            <div class=" col-sm-12 my-1 my-1 ">
                <label for="">Fecha de Nacimiento</label>
                <input class="form-control" type="date" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}"
                    id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Calle</label>
                <input class="form-control" type="text" name="calle" value="{{ $user->calle }}" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Municipio</label>
                <input class="form-control" type="text" name="municipio" value="{{ $user->municipio }}" id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Codigo Postal</label>
                <input class="form-control" type="text" name="codigo_postal" value="{{ $user->codigo_postal }}"
                    id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Estado</label>
                <input class="form-control" type="text" name="estado" value="{{ $user->estado }}" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Comporbante de Domicilio</label>
                <input accept="image/jpeg,application/pdf" class="form-control" type="file"
                    name="comprobante_domicilio" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Identificación</label>
                <input accept="image/jpeg,application/pdf" class="form-control" type="file" name="comprobante_ine" id="">
            </div>
            <div class="col-sm-12 my-1 form-check form-check-inline my-1 d-flex flex-wrap justify-content-center">
                <input class="form-check-input" type="radio" name="terminos" id="terminos" required
                    value="true">
                <label class="form-check-label" for="terminos">Acepto terminos y condiciones *</label>
            </div>
            <div class="text-center col-sm-12 col-md-3">
                <button type="submit" class="btn btn-success btn-sm"> Guardar</button>
            </div>


        </form>
    </div>
@endsection

@section('js')
    @include('sweetalert::alert')
    <script>
        function option(x) {
            var element = document.getElementById("tutor");
            element.classList.toggle("d-none");
        }
    </script>
    <script src="{{ asset('js/jquery.imgareaselect.js') }}"></script>
    <script>
        Webcam.set({
            width: 350,
            height: 250,
            image_format: 'jpg',
            jpeg_quality: 90,
            flip_horiz: true
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {

            Webcam.snap(function(data_uri) {

                $(".image-tag").val(data_uri);

                document.getElementById('results').innerHTML = '<img src="' + data_uri + '" id="previewimage"/>';
                jQuery(function($) {
                    var p = $("#previewimage");

                    $("body").on("change", ".image", function() {
                        var imageReader = new FileReader();
                        imageReader.readAsDataURL(document.querySelector(".image").files[0]);

                        imageReader.onload = function(oFREvent) {
                            p.attr('src', oFREvent.target.result).fadeIn();
                        };
                    });

                    $('#previewimage').imgAreaSelect({
                        aspectRatio: '1:1',
                        maxWidth: "250",
                        onSelectEnd: function(img, selection) {
                            $('input[name="x1"]').val(selection.x1);
                            $('input[name="y1"]').val(selection.y1);
                            $('input[name="w"]').val(selection.width);
                            $('input[name="h"]').val(selection.height);
                        }

                    });

                });
            });

        }
    </script>
@endsection
