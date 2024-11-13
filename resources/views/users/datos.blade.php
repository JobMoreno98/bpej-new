@extends('adminlte::page')
@section('title', 'Mi información')



@section('css')


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
            <div class="text-center">
                @php
                    if (isset($user->profile_photo_path)) {
                        $img = route('get-photo', $user->id);
                    }
                @endphp
                <img id="output" src="{{ isset($img) ? $img : '' }}" class="rounded-circle"
                    style="max-height: 150px;aspect-ratio: 1 / 1  ;object-fit: cover; " />
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Mi foto</label>
                <input accept="image/jpeg" class="form-control" type="file" name="profile_photo_path"
                    onchange="loadFile(event)">
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
                        onclick="option(1)" id="inlineRadio1" value="adulto"
                        {{ isset($user->tipo) ? ($user->tipo == 'adulto' ? 'checked' : '') : '' }}>

                    <label class="form-check-label" for="inlineRadio1">Adulto</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo"
                        {{ isset($user->tipo) ? ($user->tipo == 'menor' ? 'checked' : '') : '' }} id="not"
                        onclick="option(0)" id="inlineRadio2" value="menor">
                    <label class="form-check-label" for="inlineRadio2">Menor</label>
                </div>
            </div>
            <div class="col-sm-12 my-1  {{ !isset($user->tutor) ? 'd-none' : '' }} " id="tutor">
                <label for="">Tutor</label>
                <input class="form-control" type="text" name="tutor"
                    value="{{ isset($user->tutor) ? $user->tutor : null }}">
            </div>

            <div class=" col-sm-12 my-1 my-1 ">
                <label for="">Fecha de Nacimiento</label>
                <input class="form-control" type="date" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}"
                    id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Calle</label>
                <input class="form-control" type="text" name="calle" value="{{ $user->calle }} " id="">

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
                <input accept="image/jpeg,application/pdf" class="form-control" type="file" name="documento"
                    id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Identificación</label>
                <input accept="image/jpeg,application/pdf" class="form-control" type="file" name="identificacion"
                    id="">
            </div>
            <div class="col-sm-12 my-1 form-check form-check-inline my-1 d-flex flex-wrap justify-content-center">
                <input class="form-check-input" type="radio" name="terminos" id="terminos" required value="1">
                <label class="form-check-label" for="terminos">Acepto terminos y condiciones *</label>
            </div>
            <div class="text-center ">
                <button type="submit" class="btn btn-success btn-sm col-sm-12 col-md-2 w-100"> Guardar</button>
            </div>


        </form>
    </div>
@endsection

@section('js')

    <script>
        function option(x) {
            console.log(x)
            if (x === 0) {
                document.getElementById("tutor").classList.remove("d-none");
            }
            if (x === 1) {
                document.getElementById("tutor").classList.add("d-none");
            }

        }

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
