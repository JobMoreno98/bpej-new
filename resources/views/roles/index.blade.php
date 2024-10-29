@extends('adminlte::page')
@section('title', 'Roles')
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
    <div class="container">
        @if (Auth::check())

            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center">Administración de Roles</h2>
                </div>
                @if (session('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4>{{ session('message') }}</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row justify-content-end">
                <div class="col-auto mb-1">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        {{ __('Nuevo Rol') }}
                    </a>
                </div>
            </div>
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
                                                    <th scope="col">Rol</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                <tr>
                                                    <td scope="row" style="color: #666666;">{{ $role->name }}</td>
                                                    <td>{{ $role->description }}</td>
                                                    <td>
                                                        <form method="GET" action="{{ route('roles.edit', $role->id) }}">
                                                            <button type="submit" class="border-0 text-green text-red rounded"
                                                            style="background: transparent;">
                                                                <span class="material-symbols-outlined">
                                                                    edit
                                                                </span>
                                                            </button>
                                                            <a href="{{ route('asignar_permisos', $role->id) }}"><button type="button"
                                                                class="border-0 text-info text-red rounded"
                                                                style="background: transparent;">Relacionar Permisos</button> </a>
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
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
    <script type="text/javascript" src="{{ asset('js/usuarios/main.js') }}"></script>
@endsection
