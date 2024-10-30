@extends('auth.plantilla')

@section('title', __('Sign in'))


@section('content')
    <section class="bg-secondary-100 py-3 py-md-5 py-xl-8 w-100">
        <div class="container d-flex h-100 align-items-center">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="shadow card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <x-validation-errors class="mb-4" />

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="block">
                                    <label for="email"> {{ __('Email') }}</label>
                                    <input class="form-control" id="email" class="block mt-1 w-full" type="email"
                                        name="email" value="{{ old('email') }}" required autofocus
                                        autocomplete="email" />
                                </div>
                                <button class="w-100 btn btn-primary btn  my-2"
                                    type="submit">{{ __('Email Password Reset Link') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
