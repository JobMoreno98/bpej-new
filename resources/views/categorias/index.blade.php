@extends('plantilla')

@section('css')
    <style>
        .message-button:hover {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #000;
            color: #000;
        }

        .message-button {
            font-size: 8pt;
            padding: 10px 35px;
            color: #030728;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            background: #000;
            color: #fff;
            border: 1px solid transparent;
            transition: 0.2s ease;
            text-transform: uppercase
        }
    </style>
@endsection
@section('content')
    <div class="container mt-3">
        <h2 class="text-center">Categorias Literarias</h2>
        <div class="card-list d-flex flex-wrap justify-content-center flex-md-row  flex-column">
            @foreach ($categorias as $item)
                <div
                    class="border border-secondary rounded-3 
                    p-2 col-sm-12 col-md-3 mx-2 my-1 d-flex  align-items-center flex-column justify-content-center">
                    @php
                        $url = isset($item->photo) ? asset('storage/' . $item->photo) : asset('img/image-default.jpg');
                    @endphp
                    <div class="mx-2"><img src="{{ $url }}" alt="User Image" class="rounded-3"
                            style="aspect-ratio:1/1;width:200px;object-fit: cover;"></div>
                    <div class="w-100">
                        <div class="mt-2">
                            <h4 class="text-center border-bottom py-2 my-2 text-uppercase">{{ $item->name }}
                                @php
                                    $valor = Auth::check()
                                        ? (count($item->user) > 0
                                            ? "'FILL' 1"
                                            : "'FILL' 0")
                                        : "'FILL' 0";
                                @endphp
                                <button style="border: none;    background: transparent;"
                                    onclick="addCategory('{{ $item->id }}')">
                                    <div id="categoria-{{ $item->id }}"
                                        style="color:orange; font-variation-settings:{{ $valor }} , 'wght' 700, 'GRAD' 0, 'opsz' 48;">
                                        <span class="material-symbols-outlined">
                                            star
                                        </span>
                                    </div>
                                </button>

                            </h4>
                            <p class="text-justify">{{ Str::limit($item->descripcion, 250) }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $categorias->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true
        });
        var url = "{{ route('add-category') }}";
    </script>
    <script src="{{ asset('js/addCategory.js') }}"></script>
@endsection
