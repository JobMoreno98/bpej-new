@extends('adminlte::page')
@section('title', 'Editar Servicio')

@section('content_header')
    <h2 class="text-center">Editar Servicio</h2>
@endsection

@section('content')
    <div class="container ">
        <form action="{{ route('servicios.update', $servicio->id) }}"
            class="d-flex justify-content-around align-items-center flex-nowrap flex-column" method="post">
            @csrf
            @method('PUT')
            <div class="d-flex col-md-10 flex-column flex-md-row  align-items-center">
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" required value="{{ $servicio->nombre }}" class="form-control">
                </div>
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Ubicación</label>
                    <input type="text" class="form-control" value="{{ $servicio->ubicacion }}" required name="ubicacion">
                </div>
            </div>

            <div class="d-flex col-md-10  align-items-center">
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Hora inicio</label>
                    <input type="time" class="form-control" value="{{ $servicio->hora_inicio }}" name="hora_inicio">
                </div>
                <div class="col-md-5 col-sm-12 m-1">
                    <label for="">Hora fin</label>
                    <input type="time" class="form-control" value="{{ $servicio->hora_fin }}" name="hora_fin">
                </div>
            </div>

            <div class="col-md-10 col-sm-12 m-1 col-md-10">
                <label for="">Descripción</label>
                <textarea name="descripcion" id="" class="form-control" required>{{ $servicio->descripcion }}</textarea>
            </div>
            <div class="text-center m-1">
                <button type="submit" class="btn btn-bm btn-success"> Guardar</button>
            </div>
        </form>
    </div>
@endsection
