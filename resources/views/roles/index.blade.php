@extends('adminlte::page')
@section('title', 'Roles')


@section('css')
    
@endsection

@section('content')
    <div class="container justify-content-center">
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
            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                @if ($errors->any())
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="justify-content-center d-flex flex-column flex-md-row align-items-center my-2">
                    <label class="font-weight-bold mx-1" for="name" @required(true)>Rol</label>

                    <input type="text" class="form-control col-sm-12 col-md-3 mx-1" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Nombre del rol">

                    <button type="submit" class="col-sm-12 col-md-2 btn btn-success btn-sm m-1">
                        <i class="ml-1 fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
            <section class="intro col-md-10 col-sm-12">
                <div class="gradient-custom-1 h-100">
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mb-0 w-100 roundede mdl-data-table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Rol</th>
                                                    
                                                    <th scope="col text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td scope="row" style="color: #666666;">{{ $role->name }}</td>
                                                        <td class="d-flex">
                                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                                class=" text-decoration-none border-0 text-green  d-flex aling-items-center mx-1"
                                                                style="font-size: 12pt">
                                                                <span class="material-symbols-outlined">
                                                                    edit
                                                                </span>
                                                                Editar
                                                            </a>
                                                            <a href="{{ route('asignar_permisos', $role->id) }}"
                                                                class="text-decoration-none border-0 text-info d-flex aling-items-center">
                                                                <span class="material-symbols-outlined">
                                                                    add
                                                                </span>
                                                                Relacionar Permisos
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
            Favor de Iniciar Sesión
        @endif
    </div>
    <script type="text/javascript" src="{{ asset('js/usuarios/main.js') }}"></script>
@endsection
