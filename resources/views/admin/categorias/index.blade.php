@extends('adminlte::page')
@section('title', 'Categorias')


@section('css')

@endsection

@section('content_header')
    <h2 class="text-center">Categorias</h2>
@endsection

@section('content')
    <div class="container justify-content-center">
        @if (Auth::check())
            @can('CATEGORIAS#crear')
                <p class="text-end">
                    <a type="submit" href="{{ route('categorias.create') }}" class="btn btn-sm btn-primary">
                        {{ __('Nueva Categoria') }}
                    </a>
                </p>
            @endcan
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
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Activo</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categorias as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->descripcion }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input"
                                                                    onclick="home({{ $item->id }})" type="checkbox"
                                                                    role="switch" {{ $item->home ? 'checked' : '' }}>
                                                                Inicio
                                                            </div>
                                                            @can('CATEGORIAS#delete')
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input"
                                                                        onclick="desactivate({{ $item->id }})"
                                                                        type="checkbox" role="switch"
                                                                        {{ $item->active ? 'checked' : '' }}>
                                                                    Eliminar
                                                                </div>
                                                            @endcan

                                                        </td>
                                                        <td class="d-flex flex-row">
                                                            <a href="{{ route('categorias.edit', $item->id) }}"
                                                                class=" text-decoration-none border-0 text-green  d-flex aling-items-center mx-1"
                                                                style="font-size: 12pt">
                                                                <span class="material-symbols-outlined">
                                                                    edit
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
        @else
            Favor de Iniciar Sesión
        @endif
    </div>
@endsection

@section('footer')
    <p class="text-end">En caso de inconsistencias, favor de reportarlas.</p>
@endsection

@section('js')
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
                        title: data.message,
                        icon: "success"
                    });
                } else {
                    Toast.fire({
                        type: 'danger',
                        title: data.message
                    });
                }
            });
        }

        function home(element) {
            send = {
                "categoria": element,
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('home-categoria') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: send
            }).done(function(data) {
                if (data.success === true) {
                    Toast.fire({
                        type: 'success',
                        title: data.message,
                        icon: "success"
                    });
                } else {
                    Toast.fire({
                        type: 'danger',
                        title: data.message
                    });
                }
            });
        }
    </script>
@endsection
