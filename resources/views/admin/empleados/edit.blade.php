@extends('adminlte::page')
@section('title', 'Empleados')

@section('css')
    @include('layouts.head')
    <style>
        .mdc-text-field__input class="form-control" {
            border: 1px grey solid;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content_header')
    <h2 class="text-center">Empleado - {{ $empleado->name }}</h2>
@endsection



@section('content')
    <div class="container">
        <form action="{{ route('empleados.update', $empleado->id) }}" method="post">
            @method('PUT')
            @csrf
            <div>
                <label for="">{{ __('Name') }}</label>
                <input class="form-control" type="text" name="name" value="{{ $empleado->name }}">
            </div>
            <div>
                <label for="">{{ __('Email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ $empleado->email }}">
            </div>
            <div>
                <label for="">{{ __('Role') }}</label>
                <select class="form-control" name="role" id="">
                    <option disabled selected>Elegir un Rol</option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->name }}"
                            {{ $empleado->role->first()->id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">{{ __('Password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div>
                <label for="">{{ __('Confirm Password') }}</label>
                <input class="form-control" type="password" name="password_confirmation">
            </div>
            <div class="text-center my-2">
                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </form>
    </div>

@endsection
