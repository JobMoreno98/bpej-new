@extends('auth.plantilla')

@section('title', __('Register'))


@section('content')

    <section class=" py-2 py-md-5 py-xl-8 w-100" data-bs-theme="secondary">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center justify-content-center m-1 p-1 p-md-5 rounded ">
                <div class="col-12 col-md-8 col-xl-5 m-0 border rounded-4 border-dark p-1 p-md-3">
                    <div>
                        <img class="img-fluid rounded rounded-4" loading="lazy" src="{{ asset('img/portada-web.jpg') }}" width="100%"
                            height="250" alt="BootstrapBrain Logo" style="aspect-ratio: 16 / 5;object-fit: cover;">
                    </div>
                    <div class="card border-0 rounded-4" style="border:#7c2422 solid 2px;">
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
                                    <x-label for="name" value="{{ __('Name') }}" />
                                    <input class="form-control" id="name" class="block mt-1 w-full" type="text"
                                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <input class="form-control" id="email" class="block mt-1 w-full" type="email"
                                        name="email" :value="old('email')" required autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <input class="form-control" id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <input class="form-control" id="password_confirmation" class="block mt-1 w-full"
                                        type="password" name="password_confirmation" required autocomplete="new-password" />
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
