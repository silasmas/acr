@extends('layouts.auth')

@section('auth-content')

            <!-- Login block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-7">
                    <div class="card border border-default shadow-0">
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('password.store') }}">
    @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">@lang('auth.reset-password')</h3>

                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="register_former_password" value="{{ $former_password }}">

                                <!-- New password -->
                                <div class="form-floating">
                                    <input type="password" name="register_new_password" id="register_new_password" class="form-control" placeholder="@lang('miscellaneous.account.update_password.new_password')" aria-describedby="password_error_message" />
                                    <label class="form-label" for="register_new_password">@lang('miscellaneous.account.update_password.new_password')</label>
                                </div>
    @if (!empty($response_error) AND $response_error->message == $inputs['new_password'])
                                <p id="password_error_message" class="text-center mt-2 text-danger small">{{ $response_error->data }}</p>
    @endif

                                <!-- Confirm new password -->
                                <div class="form-floating mt-3">
                                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="@lang('miscellaneous.account.update_password.confirm_password')" aria-describedby="confirm_password_error_message" />
                                    <label class="form-label" for="confirm_new_password">@lang('miscellaneous.account.update_password.confirm_password')</label>
                                </div>
    @if (!empty($response_error) AND $response_error->message == $inputs['confirm_new_password'])
                                <p id="confirm_password_error_message" class="text-center mt-2 text-danger small">{{ $response_error->data }}</p>
    @endif

                                <!-- Run or go login -->
                                <div class="row g-2 mt-3 text-center">
                                    <div class="col-12">
                                        <button type="submit" class="btn acr-btn-blue btn-block rounded-pill py-3 shadow-0">@lang('miscellaneous.register')</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('login') }}">@lang('miscellaneous.cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login block End -->
@endsection
