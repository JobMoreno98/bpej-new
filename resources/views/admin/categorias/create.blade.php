@extends('adminlte::page')
@section('title', 'Crear Categoria')

@section('content_header')
    <h2 class="text-center">Crear Categoria</h2>
@endsection

@section('content')
    <div class="container">

        <h4 class="text-center">Añadir categoria</h4>
        <form method="POST" class="d-flex flex-column align-items-center justify-content-center"
            action="{{ route('categorias.store') }}" enctype="multipart/form-data">
            @csrf

            @method('POST')
            <div class="text-center">
                <img id="output" src="" class="rounded-circle"
                    style="max-height: 150px;aspect-ratio: 1 / 1  ;object-fit: cover; " />
            </div>

            <div class="col-sm-5 my-1 ">
                <input accept="image/jpeg" class="form-control" type="file" name="image" onchange="loadFile(event)">
            </div>

            <div class="col-sm-12 col-md-10 col-lg-8">
                <label for="d">Nombre</label>
                <input class="form-control" placeholder="Nombre" type="text"
                    name="name">
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8">
                <label for="d">Descripción</label>
                <textarea name="descripcion" class="form-control" id=""></textarea>
            </div>

            <button class="btn btn-sm btn-success col-sm-4 col-md-2 m-1" type="submit">Guardar</button>
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
