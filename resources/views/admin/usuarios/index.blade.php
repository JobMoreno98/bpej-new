@extends('adminlte::page')
@section('title', 'Usuarios')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection

@section('content_header')
    <h2 class="text-center">Usuarios</h2>
@endsection

@section('content')
    <div class="container justify-content-center">
        @if (Auth::check())
            @can('USUARIOS#crear')
                <div class="row">
                    <div class="col-auto mb-1">
                        <br>
                        <form method="POST" action="{{ route('usuarios.create') }}">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Nuevo Usuario') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endcan
            <section class="intro col-md-10 col-sm-12">
                <div class="gradient-custom-1 h-100">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table mb-0 w-100 roundede mdl-data-table"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Email</th>
                                                    <th>Activo</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $usuario)
                                                    <tr>
                                                        <td>{{ $usuario->name }}</td>
                                                        <td>{{ $usuario->email }}</td>
                                                        <td>Activo</td>
                                                        <td class="d-flex flex-row">
                                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                                class="btn-sm btn m-1 btn-primary">
                                                                Editar
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
