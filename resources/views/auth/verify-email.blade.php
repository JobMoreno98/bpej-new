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
                                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                                </div>
                            @endif

                            <div class="mt-4 flex items-center justify-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf

                                    <div>
                                        <button type="submit" class="w-100 btn btn-primary btn  my-2">
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center">

                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf

                                        <button class="btn btn-secondary btn  btn-sm my-2" type="submit"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
