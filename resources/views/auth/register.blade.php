@extends('auth.plantilla')

@section('title', __('Register'))


@section('content')
    <section class="bg-primary py-3 py-md-5 py-xl-8 w-100">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-bg-primary">
                        <div class="col-12 col-xl-9">
                            <img class="img-fluid rounded mb-4" loading="lazy"
                                src="https://bpej.udg.mx/sites/default/files/2021-09/portada-web-final-light.jpg"
                                width="100%" height="150" alt="BootstrapBrain Logo">
                            <hr class="border-primary-subtle mb-4">
                            <h2 class="h1 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                            <p class="lead mb-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, aut
                                natus eligendi ex sunt vitae laboriosam, fugit, beatae reiciendis ab inventore delectus
                                molestiae reprehenderit ducimus obcaecati repellendus tenetur repudiandae ad.</p>
                            <div class="text-endx">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                    class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                                    <path
                                        d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3>{{ __('Register') }}</h3>
                                        <p><a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @method('POST')
                                @csrf
                                <div>
                                    <label for="name" value="{{ __('Name') }}" />
                                    <input class="form-control" id="name" class="block mt-1 w-full" type="text"
                                        name="name" required autofocus autocomplete="name" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <input class="form-control" id="email" class="block mt-1 w-full" type="email"
                                        name="email" required autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <label for="password"> {{ __('Password') }}</label>
                                    <input class="form-control" id="password" class="block mt-1 w-full" type="password"
                                        name="password" required />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <input class="form-control" id="password_confirmation" class="block mt-1 w-full"
                                        type="password" name="password_confirmation" required />
                                </div>
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-check my-3">
                                        <input class="form-check-input" type="checkbox" value="" name="terms"
                                            id="terms" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </label>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn my-2"
                                            type="submit">{{ __('Register') }}</button>
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
