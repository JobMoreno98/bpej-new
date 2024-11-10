@extends('adminlte::page')
@section('title', 'Modulos')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    

@endsection

@section('content_header')
    <h2 class="text-center">Modulos</h2>
@endsection

@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            @can('MODULOS#crear')
                <div class=" col-sm-12 my-2">
                    <form action="{{ route('modulos.store') }}" class="d-flex align-items-center" method="post">
                        @csrf
                        <div class="mx-1">
                            <input type="text" placeholder="Nombre" name="nombre" class="form-control">
                        </div>
                        <div class="mx-1">
                            <input type="text" placeholder="Nombre permiso" name="permiso" class="form-control">
                        </div>
                        <div class="mx-1">
                            <input type="text" placeholder="Icono" name="icono" class="form-control">
                        </div>
                        <div class="mx-1">
                            <input type="number" placeholder="Orden de ubicación" name="orden" class="form-control">
                        </div>

                        <div class="mx-1">
                            <input type="color" placeholder="Color" name="color" value="#563d7c"
                                class="form-control form-control-color">
                        </div>
                        <div class="mx-1">
                            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                        </div>

                    </form>
                </div>
            @endcan
            <section class="intro col-sm-12">
                <div class="gradient-custom-1 h-100">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table mb-0 w-100 roundede mdl-data-table"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Color</th>
                                                    <th>Icon</th>
                                                    <th>Orden</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($modulos as $item => $value)
                                                    <tr>
                                                        <td>{{ $value->nombre }}</td>
                                                        <td>{{ $value->color }}</td>
                                                        <td>{{ $value->icono }}</td>
                                                        <td>{{ $value->orden }}</td>
                                                        <td><a href="{{ route('modulos.edit', $value->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                <span class="material-symbols-outlined">
                                                                    edit
                                                                </span></a>

                                                            <a href="{{ route('modulos.destroy', $value) }}"
                                                                class="btn btn-sm btn-danger">
                                                                <span class="material-symbols-outlined">
                                                                    delete
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    </div>
@else
    No tienes permisos para acceder a este apartado
    @endif
@endsection

@section('js')
    @include('layouts.scripts')
@endsection

@section('footer')
    <h6 class="text-end">Favor de reportar cualquier falla</h6>
@endsection
