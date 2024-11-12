@extends('adminlte::page')
@section('title', 'Crear Servicio')

@section('content_header')
    <h2 class="text-center">Crear Servicio</h2>
@endsection

@section('content')
    <div class="container ">
        <form action="{{ route('servicios.store') }}"
            class="d-flex justify-content-around align-items-center flex-nowrap flex-column" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            @php
                if (isset($user->profile_photo_path)) {
                    $img = route('get-photo', $user->id);
                }
            @endphp
            <img id="output" src="{{ isset($img) ? $img : '' }}" class="rounded-circle"
                style="max-height: 150px;aspect-ratio: 1 / 1  ;object-fit: cover; " />

            <div class="col-sm-5 my-1 ">
                <input accept="image/jpeg" class="form-control" type="file" name="image"
                    onchange="loadFile(event)">
            </div>
            <div class="d-flex col-md-10 flex-column flex-md-row  align-items-center">
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" required value="{{ old('nombre') }}" class="form-control">
                </div>
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Ubicación</label>
                    <input type="text" class="form-control" value="{{ old('ubicacion') }}" required name="ubicacion">
                </div>
            </div>

            <div class="d-flex col-md-10  align-items-center">
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Hora inicio</label>
                    <input type="time" class="form-control" value="{{ old('hora_inicio') }}" name="hora_inicio">
                </div>
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Hora fin</label>
                    <input type="time" class="form-control" value="{{ old('hora_fin') }}" name="hora_fin">
                </div>
            </div>

            <div class="col-md-10 col-sm-12 m-1 col-md-10">
                <label for="">Descripción</label>
                <textarea name="descripcion" id="" class="form-control" required>{{ old('descripcion') }}</textarea>
            </div>
            <div class="text-center m-1">
                <button type="submit" class="btn btn-bm btn-success"> Guardar</button>
            </div>
        </form>
    </div>

@endsection
@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
