@extends('adminlte::page')
@section('title', 'Relacionar rol')

@section('css')
    

@endsection

@section('content_header')
    <h2 class="text-center mt-2 w-100"><span class=" border-bottom">Asignar permisos a rol - {{ $rol->name }} </span> </h2>
@endsection
@section('content')
    <div class="container-fluid">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <form action="{{ route('guardar_relacion_permisos', $rol->id) }}" method="post">
                @csrf
                <div class="d-flex flex-wrap align-items-center w-100 justify-content-evenly">

                    @foreach ($permisos as $key => $value)
                        <div class="card m-1 col-sm-12 col-lg-3 col-md-5 h-100">
                            <div class="card-body h-100">
                                <h5 class=" w-100 border-bottom mb-1 pb-1">{{ $key }}</h5>
                                <div>
                                    @foreach ($value as $item)
                                        <div class="form-check">
                                            <input name="permisos_seleccionados[]" class="form-check-input" type="checkbox"
                                                value="{{ $item->permiso_id }}" id="flexCheckChecked"
                                                {{ isset($item->input) ? $item->input : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                {{ $item->nombre_permiso }}

                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 text-center my-2">
                        <button type="submit" class="btn btn-sm btn-success">Enviar</button>
                    </div>
                </div>

            </form>
        @else
            Favor de Iniciar Sesión
        @endif
    </div>
@endsection
