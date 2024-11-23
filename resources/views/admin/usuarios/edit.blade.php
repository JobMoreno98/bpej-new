@extends('adminlte::page')
@section('title', 'Editar usuario')

@section('css')

    <link rel="stylesheet" href="{{ asset('css/imgareaselect.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

@endsection

@section('content')
    <div class="container justify-content-center d-flex">
        <form action="{{ route('usuarios.update', $user->id) }}" class="d-flex flex-wrap flex-column  col-sm-12 my-1 col-md-8"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center">
                @php
                    if (isset($user->profile_photo_path)) {
                        $img = route('get-photo-admin', $user->id);
                    }
                @endphp
                <img id="output" src="{{ isset($img) ? $img : '' }}" class="rounded-circle"
                    style="max-height: 150px;aspect-ratio: 1 / 1  ;object-fit: cover; " />
            </div>

            <div class="accordion accordion-flush mt-2" id="accordionFlushExample">
                <div class="accordion-item ">
                    <h2 class="accordion-header ">
                        <button class="accordion-button collapsed border-secoundary border rounded-2" type="button"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            Fotografía
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-center">

                                <div class="col-md-6 d-flex justify-content-center flex-column align-items-center">

                                    <div id="my_camera" class="w-100"></div>

                                    <input type=button value="Tomar foto"
                                        class="d-none d-md-block my-2 col-sm-12 col-md-3 btn btn-outline-dark btn-sm"
                                        onClick="take_snapshot()">

                                    <input type="hidden" name="image" class="image-tag">

                                    <input type="hidden" name="x1" value="" />
                                    <input type="hidden" name="y1" value="" />
                                    <input type="hidden" name="w" value="" />
                                    <input type="hidden" name="h" value="" />
                                </div>
                                <div class="col-md-6 d-none d-md-block">
                                    <div id="results"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12 my-1  " id="nombre">
                <label for="">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="{{ $user->name }}">
            </div>
            <div class="col-sm-12 my-1 " id="email">
                <label for="">Correo</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="d-flex align-items-center col-sm-12 my-1 justify-content-evenly">
                <label for="">Eres *</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="" id="yes"
                        onclick="option(1)" id="inlineRadio1" value="adulto"
                        {{ isset($user->tipo) ? ($user->tipo == 'adulto' ? 'checked' : '') : '' }}>

                    <label class="form-check-label" for="inlineRadio1">Adulto</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo"
                        {{ isset($user->tipo) ? ($user->tipo == 'menor' ? 'checked' : '') : '' }} id="not"
                        onclick="option(0)" id="inlineRadio2" value="menor">
                    <label class="form-check-label" for="inlineRadio2">Menor</label>
                </div>
            </div>
            <div class="col-sm-12 my-1  {{ !isset($user->tutor) ? 'd-none' : '' }}" id="tutor">
                <label for="">Tutor</label>
                <input class="form-control" type="text" name="tutor"
                    value="{{ isset($user->tutor) ? $user->tutor : null }}">
            </div>

            <div class=" col-sm-12 my-1 my-1 ">
                <label for="">Fecha de Nacimiento</label>
                <input class="form-control" type="date" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}"
                    id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Calle y número</label>
                <input class="form-control" type="text" name="calle" value="{{ $user->calle }}" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Colonia</label>
                <input class="form-control" type="text" name="colonia" value="{{ $user->colonia }}" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Municipio</label>
                <input class="form-control" type="text" name="municipio" value="{{ $user->municipio }}"
                    id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Código Postal</label>
                <input class="form-control" type="text" name="codigo_postal" value="{{ $user->codigo_postal }}"
                    id="">
            </div>
            <div class=" col-sm-12 my-1 ">
                <label for="">Estado</label>
                <input class="form-control" type="text" name="estado" value="{{ $user->estado }}" id="">
            </div>

            <div class="col-sm-12 my-1 ">
                <label for="">Comprobante de Domicilio</label>
                <div class="d-flex">
                    <input accept="image/jpeg,application/pdf" class="form-control" type="file" name="documento"
                        id="">
                    @if (isset($user->documento))
                        @can('USUARIOS#update')
                            <a target="_blank"
                                href="{{ route('get-file-admin', ['id' => $user->id, 'type' => 'documento']) }}"
                                class="btn btn-primary mx-1">Ver</a>
                        @endcan
                    @endif
                </div>

            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Identificación</label>
                <div class="d-flex">
                    <input accept="image/jpeg,application/pdf" class="form-control" type="file" name="identificacion"
                        id="">
                    @if (isset($user->identificacion))
                        @can('USUARIOS#update')
                            <a target="_blank"
                                href="{{ route('get-file-admin', ['id' => $user->id, 'type' => 'identificacion']) }}"
                                class="btn btn-primary mx-1">Ver</a>
                        @endcan
                    @endif
                </div>
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Clave BPEJ</label>
                <input class="form-control-plaintext" type="text" name="clave_bpej" readonly
                    value="{{ $user->clave_bpej }}" id="">
            </div>
            <div class="col-sm-12 my-1 ">
                <label for="">Clave RFID</label>
                <input class="{{ isset($user->clave_rfid) ? 'form-control-plaintext' : 'form-control' }} " type="text"
                    name="clave_rfid" {{ isset($user->clave_rfid) ? 'readonly' : '' }} value="{{ $user->clave_rfid }}"
                    id="">
            </div>
            <div class="d-flex flex-column flex-md-row  justify-content-center my-3 align-items-center">
                <div class="form-check col-sm-12 col-md-5 col-lg-4 text-end">
                    <input class="form-check-input" type="checkbox" name="aleph"
                        {{ isset($user->clave_rfid) ? 'checked readonly' : '' }} id="aleph">
                    <label class="form-check-label fw-bold" for="aleph">
                        Registro Aleph
                    </label>
                </div>
                <div class="col-sm-12 col-md-5 d-flex  align-items-center">
                    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" name="fecha_impresion"
                        {{ isset($user->fecha_impresion) ? 'checked disabled' : '' }} autocomplete="off">
                    <label class="btn btn-outline-success" for="btn-check-2-outlined">Credencial Impresa</label>
                    @if (isset($user->fecha_impresion))
                        <p class="mx-1">Fecha: {{ $user->fecha_impresion }}</p>
                    @endif

                </div>
            </div>
            foito
            <img src="{{ Storage::disk('files')->get($user->profile_photo_path) }}" alt="">
            <div class="text-center col-sm-12 mt-1">
                <button type="submit" class="btn btn-success btn-sm"> Guardar</button>
            </div>


        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.imgareaselect.js') }}"></script>
    <script src="{{ asset('js/editUser.js') }}"></script>
@endsection
