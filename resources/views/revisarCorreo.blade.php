@extends('auth.plantilla')

@section('title', __('Sign in'))


@section('content')
    <section class="bg-secondary-100 py-3 py-md-5 py-xl-8 w-100">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="shadow card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <x-validation-errors class="mb-4" />
                            <div class="my-2">
                                <img class="img-fluid rounded " loading="lazy" src="{{ asset('img/portada-web.jpg') }}"
                                    width="100%" height="250" alt="BootstrapBrain Logo"
                                    style="aspect-ratio: 16 / 5;object-fit: cover;">
                            </div>

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? .') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
