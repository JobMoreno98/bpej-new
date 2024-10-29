@extends('adminlte::page')
@section('title', 'Permisos')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
    <style>
        td {
            padding: 10px;
        }

        .content-wrapper {
            background: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row mt-2">
                <h2>Administración de Permisos</h2>
            </div>
            <div class="d-flex justify-content-betteewn">
                @can('PERMISOS#crear')
                    <div class="col-sm-12 col-md-3">
                        <form method="POST" action="{{ route('permisos.store') }}">
                            @csrf
                            <div class="d-flex flex-column justify-content-center">
                                <div class="m-1">
                                    <label for="permiso" class="col-form-label text-md-right">{{ __('Nuevo Permiso') }}</label>
                                </div>
                                <div class="m-1">
                                    <input id="permiso" type="text" class="form-control" name="permiso"
                                        placeholder="NOMBRE_DEL_MODULO#accion" required>
                                </div>
                                <div class="m-1">
                                    <select name="guard" id="" class="form-control" required>
                                        <option disabled selected>Elegir opción</option>
                                        <option value="web">Web</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class=" m-1">
                                    <button type="submit" class="btn btn-primary">{{ __('Nuevo Permiso') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endcan
                <section class="intro col-md-9 col-sm-12">
                    <div class="gradient-custom-1 h-100">
                        <div class="mask d-flex align-items-center h-100">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0 w-100 roundede" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Modulo</th>
                                                        <th scope="col">Permiso</th>
                                                        <th scope="col">Guard</th>
                                                        <th scope="col">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permisos as $permiso)
                                                        <tr>
                                                            <th scope="row" style="color: #666666;">
                                                                {{ $permiso['modulo'] }}</th>
                                                            <td>{{ $permiso['permiso'] }}</td>
                                                            <td>{{ $permiso['guard'] }}</td>
                                                            <td>
                                                                <form method="POST"
                                                                    action="{{ route('permisos.destroy', $permiso['id']) }}">
                                                                    @method('Delete')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="border-0 text-red text-red rounded"
                                                                        style="background: transparent;">
                                                                        <span class="material-symbols-rounded">
                                                                            delete
                                                                        </span>
                                                                    </button>
                                                                </form>
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
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('js')
    @include('layouts.scripts')
@endsection
