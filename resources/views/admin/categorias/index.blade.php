@extends('adminlte::page')
@section('title', 'Categorias')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection

@section('content_header')
    <h2 class="text-center">Categorias</h2>
@endsection

@section('content')
    <div class="container justify-content-center">
        @if (Auth::check())
            @can('CATEGORIAS#crear')
                <div class="row">
                    <div class="col-12 mb-1">
                        <h4 class="text-center">Añadir categoria</h4>
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
                        <form method="POST" class="d-flex" action="{{ route('categorias.store') }}">

                            @csrf
                            @method('POST')
                            <input class="form-control mx-1 col-sm-12 col-md-3" placeholder="Nombre" type="text"
                                name="name">
                            <input class="form-control mx-1 col-sm-12 col-md-8" placeholder="Descripción" type="text"
                                name="descripcion">
                            <button class="btn btn-sm btn-success" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            @endcan
            <hr>
            <section class="intro col-sm-12">
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
                                                    <th>Descripción</th>
                                                    <th>Activo</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categorias as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->descripcion }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input"
                                                                    onclick="desactivate({{ $item->id }})"
                                                                    type="checkbox" role="switch"
                                                                    {{ $item->active ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex flex-row">
                                                            <a href="{{ route('categorias.edit', $item->id) }}"
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
    <p class="text-end">En caso de inconsistencias, favor de reportarlas.</p>
@endsection

@section('js')
    @include('sweetalert::alert')
    @include('layouts.scripts')
    <script>
        function desactivate(element) {
            send = {
                "categoria": element,
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('desactivar-categoria') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: send
            }).done(function(data) {
                if (data.success === true) {
                    Toast.fire({
                        type: 'success',
                        title:  data.message,
                        icon: "success"
                    });
                } else {
                    Toast.fire({
                        type: 'danger',
                        title:  data.message
                    });
                }
            });
        }
    </script>
@endsection
