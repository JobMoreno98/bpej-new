@extends('adminlte::page')
@section('title', 'Mis categorias')



@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">

@endsection


@section('content')
    <div class="container">
        <form action="{{ route('user.caterogiras-store') }}" method="post">
            @csrf
            @method('POST')
            <div class="d-flex flex-wrap">
                @foreach ($categorias as $item => $value)
                    <div class="col-lg-4 mt-3">
                        <div class="card card-margin">
                            <div class="card-header no-border">
                                <h5 class="card-title">{{ $value->name }}</h5>
                            </div>
                            
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <div class="widget-49-title-wrapper">
                                        {{--
                                        <div class="widget-49-date-primary">
                                            <span class="widget-49-date-day">09</span>
                                            <span class="widget-49-date-month">apr</span>
                                        </div>
                                        --}}
                                        <div class="widget-49-meeting-info">
                                            <span class="widget-49-pro-title"> {{ $value->descripcion }}</span>

                                        </div>
                                    </div>
                                    <div class="widget-49-meeting-action">
                                        <a href="#" class="btn btn-sm btn-flash-border-primary">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="categorias[]" value="{{ $value->id }}"
                                                    {{ $value->users_id == Auth::user()->id ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="switchCheckChecked">{{ $value->users_id == Auth::user()->id ? 'Me gusta' : 'No Me gusta' }}</label>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>

@endsection

@section('js')
    
@endsection
