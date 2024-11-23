@extends('adminlte::page')
@section('title', 'Usuarios')



@section('css')

    <style>
        .mdc-text-field__input {
            border: 1px grey solid;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content_header')
    <h2 class="text-center">Usuarios</h2>
@endsection

@section('content')
    <div class="container d-flex flex-column align-itens-center justify-content-center">
        @if (Auth::check())
            @can('USUARIOS#crear')
                <div class="row justify-content-end">
                    <div class="col-auto mb-1 ">
                        <a type="submit" href="{{ route('usuarios.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Nuevo Usuario') }}
                        </a>
                    </div>
                </div>
            @endcan
            <section class="p-0 intro col-sm-12">
                <div class="row justify-content-center">
                    <div class="col-12 p-0">
                        <div class="table-responsive">
                            <table id="myTable" class="table mb-0 w-100 roundede mdl-data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Tipo</th>
                                        <th>Clave BPEJ</th>
                                        <th>Clave RFID</th>
                                        @can('USUARIOS#update')
                                            <th>Accion</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ Str::ucfirst($usuario->tipo) }}</td>
                                            <td class="text-start">{{ $usuario->clave_bpej }}</td>
                                            <td>{{ isset($usuario->clave_rfid) ? $usuario->clave_rfid : 'No capturado' }}
                                            </td>
                                            @can('USUARIOS#update')
                                                <td class="d-flex flex-row">
                                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                        class=" text-decoration-none border-0 text-green  d-flex aling-items-center mx-1"
                                                        style="font-size: 12pt">
                                                        <span class="material-symbols-outlined">
                                                            edit
                                                        </span>
                                                    </a>
                                                </td>
                                            @endcan

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
