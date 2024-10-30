@extends('adminlte::page')
@section('title', 'Mi información')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content_header')
    <h2 class="text-center">Mi información</h2>
@endsection

@section('content')
    <div class="container justify-content-center d-flex">
        <form action="" class="d-flex flex-wrap flex-column  col-sm-12 my-1 col-md-8" method="post">
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
                <input class="form-control" type="date" name="fecha_nacimiento" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Calle</label>
                <input class="form-control" type="text" name="" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Municipio</label>
                <input class="form-control" type="text" name="" id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Codigo Postal</label>
                <input class="form-control" type="text" name="" id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Estado</label>
                <input class="form-control" type="text" name="" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Comporbante de Domicilio</label>
                <input class="form-control" type="file" name="" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Identificación</label>
                <input class="form-control" type="file" name="" id="">
            </div>
            <div class="form-check form-check-inline my-1 d-flex justify-content-center">
                <input class="form-check-input" type="radio" name="terminos" id="inlineRadio2" required value="true">
                <label class="form-check-label" for="inlineRadio2">Acepto terminos y condiciones *</label>
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
@endsection
