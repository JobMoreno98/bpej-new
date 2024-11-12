@extends('adminlte::page')
@section('title', 'Servicios')

@section('content_header')
    <h2 class="text-center">Servicios</h2>
@endsection

@section('content')
    <div class="container d-flex flex-column align-itens-center justify-content-center">
        @if (Auth::check())
            @can('SERVICIOS#crear')
                <div class="row justify-content-end">
                    <div class="col-auto mb-1 ">
                        <a type="submit" href="{{ route('servicios.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Nuevo Servicio') }}
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
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Ubicación</th>
                                                    <th>Horario</th>
                                                    <th>Activo</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($servicios as $servicio)
                                                    <tr>
                                                        <td>{{ $servicio->id }}</td>
                                                        <td>{{ $servicio->nombre }}</td>
                                                        <td>{{ $servicio->ubicacion }}</td>
                                                        <td>{{ $servicio->horario }}</td>
                                                        <td class="d-flex">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input"
                                                                    onclick="home({{ $servicio->id }})" type="checkbox"
                                                                    role="switch" {{ $servicio->home ? 'checked' : '' }}>
                                                                Inicio
                                                            </div>
                                                            @can('SERVICIOS#delete')
                                                                <div class="form-check form-switch mx-1">
                                                                    <input class="form-check-input"
                                                                        onclick="desactivate({{ $servicio->id }})"
                                                                        type="checkbox" role="switch"
                                                                        {{ $servicio->active ? 'checked' : '' }}>
                                                                </div>
                                                                Eliminar
                                                            @endcan
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('servicios.edit', $servicio->id) }}"
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
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('js')

    <script>
        function desactivate(element) {
            send = {
                "servicio": element,
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('desactivar-servicio') }}";
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
                "servicio": element,
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('home-servicio') }}";
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
