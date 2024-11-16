@extends('auth.plantilla')

@section('title', __('Sign in'))

@section('content')
{{--
    <section class="py-md-5 py-xl-8 w-100" data-bs-theme="secondary">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center justify-content-center m-1 p-2 p-md-5 rounded ">
                <div class="col-12 col-md-8 col-xl-5 m-0 border rounded-4 border-dark p-1 p-md-3">
                    <div>
                        <img class="img-fluid rounded rounded-4" loading="lazy" src="{{ asset('img/portada-web.jpg') }}" width="100%"
                            height="250" alt="BootstrapBrain Logo" style="aspect-ratio: 16 / 5;object-fit: cover;">
                    </div>
                    <div class="card border-0 rounded-4" style="border:#7c2422 solid 2px;">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4 text-center">
                                        <h3>{{ __('Sign in') }}</h3>
                                        @if (Route::is('login'))
                                            <p>{{ __('Do not have an account?') }} <a
                                                    href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <form action="{{ isset($guard) ? url($guard . '/login') : route('login') }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="name@example.com" required>
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" value="" placeholder="Password" required>
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary " type="submit">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if (Route::is('login'))
                                <div class="row">
                                    <div class="col-12">
                                        <div
                                            class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-4">
                                            <a
                                                href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

--}}

@endsection
