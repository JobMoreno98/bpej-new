@extends('adminlte::page')
@section('title', 'Rol create')
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Nuevo Rol</h2>
                </div>
                <hr>
            </div>


            <br>
            <div class="row align-items-center">
                <br>
                <div class="col-12 ml-3">
                    <h6>En caso de inconsistencias, favor de reportarlas.</h6>
                </div>
                <hr>
            </div>
        @endif
    </div>
@endsection
