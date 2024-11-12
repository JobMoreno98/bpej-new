@extends('adminlte::page')
@section('title', 'Editar Categoria')

@section('content_header')
    <h2 class="text-center">Editar Categoria - {{ $categoria->name }}</h2>
@endsection

@section('content')
    <div class="container ">
        <form action="{{ route('categorias.update', $categoria->id) }}"
            class="d-flex justify-content-around align-items-center flex-nowrap flex-column" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center">
                <img id="output" src="{{ asset('storage/' . $categoria->photo) }}" class="rounded-circle"
                    style="max-height: 150px;aspect-ratio: 1 / 1  ;object-fit: cover; " />
            </div>
            <div class="col-sm-5 my-1 ">
                <input accept="image/jpeg" class="form-control" type="file" name="image" onchange="loadFile(event)">
            </div>
            <div class="col-md-10 col-sm-12 m-1">
                <label for="">Nombre</label>
                <input type="text" name="name" required value="{{ $categoria->name }}" class="form-control">
            </div>
            <div class="col-md-10 col-sm-12 m-1">
                <label for="">Descripción</label>
                <textarea name="descripcion" id="" class="form-control" required>{{ $categoria->descripcion }}</textarea>
            </div>
            <div class="text-center m-1">
                <button type="submit" class="btn btn-bm btn-success"> Guardar</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
