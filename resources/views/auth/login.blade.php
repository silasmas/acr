@extends('layouts.auth')

@section('auth-content')

            <!-- Login block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-8">
                    <div class="card border border-default shadow-0">
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('login') }}">
    @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">{{ __('miscellaneous.login_title2') }}</h3>

                                <!-- User name -->
                                <div class="form-floating">
                                    <input type="text" name="username" id="username" class="form-control" aria-describedby="username_error_message" value="{{ !empty($inputs['username']) ? $inputs['username'] : '' }}" {{ !empty($inputs['username']) ? '' : 'autofocus' }} />
                                    <label class="form-label" for="username">{{ __('miscellaneous.login_username') }}</label>
                                </div>
    @if (!empty($response_error) AND $response_error->message == $inputs['username'])
                                <p id="username_error_message" class="text-center mb-4 text-danger small">{{ $response_error->data }}</p>

                                <!-- Password -->
                                <div class="form-floating mb-3">
    @else

                                <!-- Password -->
                                <div class="form-floating mt-4">
    @endif

                                    <input type="password" name="password" id="password" class="form-control" aria-describedby="password_error_message" {{ !empty($inputs['username']) ? 'autofocus' : '' }} />
                                    <label class="form-label" for="password">{{ __('miscellaneous.password.label') }}</label>
                                </div>
    @if (!empty($response_error) AND $response_error->message == $inputs['password'])
                                <p id="password_error_message" class="text-center mb-4 text-danger small">{{ $response_error->data }}</p>

                                <!-- Remember me -->
                                <div class="row mb-3">
    @else
                                <!-- Remember me -->
                                <div class="row my-4">
    @endif
                                    <div class="col d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me" />
                                            <label class="form-check-label" for="remember_me">{{ __('miscellaneous.remember_me') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Run login -->
                                <button type="submit" class="btn acr-btn-blue btn-block py-3 mb-4 shadow-0">{{ __('miscellaneous.connection') }}</button>

                                <!-- Register or recover account -->
                                <div class="row text-center">
                                    <div class="col-sm-6 mb-sm-0 mb-2">
                                        <a href="{{ route('password.request') }}">{{ __('miscellaneous.forgotten_password') }}</a>
                                    </div>
                                    <div class="col-sm-6">
                                            <a href="{{ route('register') }}">{{ __('miscellaneous.go_register') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login block End -->
@endsection
