@extends('adminlte::page')
@section('title', 'Empleados')



@section('css')
    
    <style>
        .mdc-text-field__input {
            border: 1px grey solid;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content_header')
    <h2 class="text-center">Empleados</h2>
@endsection

@section('content')
    <div class="container d-flex flex-column align-itens-center justify-content-center">
        @if (Auth::check())
            @can('EMPLEADOS#crear')
                <div class="row justify-content-end">
                    <div class="col-auto mb-1 ">
                        <a type="submit" href="{{ route('empleados.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Nuevo Empelado') }}
                        </a>
                    </div>
                </div>
            @endcan
            <section class="p-0 intro col-sm-12">
                <div class="gradient-custom-1 h-100">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 p-0">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table mb-0 w-100 roundede mdl-data-table"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Email</th>
                                                    <th>Rol</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($empleados as $empleado)
                                                    <tr>
                                                        <td>{{ $empleado->name }}</td>
                                                        <td>{{ $empleado->email }}</td>
                                                        <td>{{ $empleado->getRoleNames() }}</td>
                                                        <td class="d-flex">
                                                            @can('EMPLEADOS#editar')
                                                                <a href="{{ route('empleados.edit', $empleado->id) }}"
                                                                    class=" text-decoration-none border-0 text-green  d-flex aling-items-center mx-1"
                                                                    style="font-size: 12pt">
                                                                    <span class="material-symbols-outlined">
                                                                        edit
                                                                    </span>
                                                                    Editar
                                                                </a>
                                                            @endcan
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
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection

@section('js')
    @include('layouts.scripts')
@endsection
