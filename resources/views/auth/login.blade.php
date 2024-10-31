@extends('auth.plantilla')

@section('title', __('Sign in'))


@section('content')
    <section class=" py-3 py-md-5 py-xl-8 w-100" data-bs-theme="secondary">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center  m-1 p-2 p-md-5 rounded " style="border:#7c2422 solid 2px;">
                <div class="col-12 col-md-6 col-xl-7 m-0">
                    <div class="d-flex flex-column justify-content-center text-bg-primary rounded">
                        <div>
                            <img class="img-fluid rounded " loading="lazy"
                                src="https://bpej.udg.mx/sites/default/files/2021-09/portada-web-final-light.jpg"
                                width="100%" height="250" alt="BootstrapBrain Logo"
                                style="aspect-ratio: 16 / 5;
    object-fit: cover;">
                        </div>

                        <div class="p-2 d-none d-md-block mt-2">

                            <hr class="border-primary-subtle mb-2">
                            <h5 class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
                            <p class="mb-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, aut
                                natus eligendi ex sunt vitae laboriosam, fugit, beatae reiciendis ab inventore delectus
                                molestiae reprehenderit ducimus obcaecati repellendus tenetur repudiandae ad.</p>
                            <div class="text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                    class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                                    <path
                                        d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5 m-0">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3>{{ __('Sign in') }}</h3>
                                        <p>{{ __('Do not have an account?') }} <a
                                                href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ isset($guard) ? url($guard . '/login') : route('login') }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="name@example.com" required>
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="" placeholder="Password" required>
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary " type="submit">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-4">
                                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
