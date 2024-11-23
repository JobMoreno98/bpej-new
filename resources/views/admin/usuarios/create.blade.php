@extends('adminlte::page')
@section('title', 'Crear usuario')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/imgareaselect.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

@endsection

@section('content')
    <div class="container justify-content-center d-flex">
        <form action="{{ route('usuarios.store') }}" class="d-flex flex-wrap flex-column   col-sm-12 my-1 col-md-8"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="justify-content-center d-none d-md-flex">

                <div class="col-md-6 d-flex justify-content-center flex-column align-items-center">

                    <div id="my_camera" class="w-100"></div>

                    <input type="button" value="Tomar foto" class="my-2 col-sm-12 col-md-3 btn btn-outline-dark btn-sm"
                        onClick="take_snapshot()">

                    <input type="hidden" name="image" class="image-tag">

                    <input type="hidden" name="x1" value="" />
                    <input type="hidden" name="y1" value="" />
                    <input type="hidden" name="w" value="" />
                    <input type="hidden" name="h" value="" />
                </div>
                <div class="col-md-6">
                    <div id="results"></div>
                </div>
            </div>
            <div class="d-md-none d-block">
                <input type="file" accept="image/*" name="profile_image">
            </div>
            <div class="col-sm-12 my-1  " id="nombre">
                <label for="">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
            <div class="col-sm-12 my-1 " id="correo">
                <label for="">Correo</label>
                <input class="form-control" type="text" name="email">
            </div>
            <div class="d-flex align-items-center col-sm-12 my-1 justify-content-evenly">
                <label for="">Es *</label>
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
                <input class="form-control" type="date" name="fecha_nacimiento" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Calle</label>
                <input class="form-control" type="text" name="calle" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Municipio</label>
                <input class="form-control" type="text" name="municipio" id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Codigo Postal</label>
                <input class="form-control" type="text" name="codigo_postal" id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Estado</label>
                <input class="form-control" type="text" name="estado" id="">
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
            <div class="col-sm-12 my-1 ">
                <label for="">Clave BPEJ</label>
                <input class="form-control" type="text" name="clave_bpej"
                    id="">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm"> Guardar</button>
            </div>

        </form>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/jquery.imgareaselect.js') }}"></script>
    <script src="{{ asset('js/editUser.js') }}"></script>
@endsection