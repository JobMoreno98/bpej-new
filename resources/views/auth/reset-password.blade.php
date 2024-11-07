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
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="block">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button>
                                        {{ __('Reset Password') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
