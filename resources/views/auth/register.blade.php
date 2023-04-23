@extends('layouts.auth')

@section('auth-content')

            <!-- Register block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-8">
                    <div class="card border border-default shadow-0">
                        <div class="card-body py-5">
    @if (Route::is('register'))
                            <form method="POST" action="{{ route('register') }}">
        @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">{{ __('miscellaneous.register_title2') }}</h3>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="register_firstname" id="register_firstname" class="form-control" placeholder="@lang('miscellaneous.firstname')" required autofocus>
                                            <label for="register_firstname">@lang('miscellaneous.firstname')</label>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="register_surname" id="register_surname" class="form-control" placeholder="@lang('miscellaneous.surname')">
                                            <label for="register_surname">@lang('miscellaneous.surname')</label>
                                        </div>
                                    </div>
    
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-sm-5">
                                                <div class="form-floating pt-0">
                                                    <select name="select_country" id="select_country1" class="form-select pt-2 shadow-0">
                                                        <option class="small" selected disabled>@lang('miscellaneous.choose_country')</option>
        @forelse ($countries as $country)
                                                        <option value="+{{ $country->country_phone_code }}">{{ $country->country_name }}</option>
        @empty
                                                        <option>@lang('miscellaneous.empty_list')</option>
        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <span id="phone_code_text1" class="input-group-text d-inline-block h-100 bg-light" style="padding-top: 0.3rem; padding-bottom: 0.5rem; line-height: 1.35;">
                                                        <small class="text-secondary m-0 p-0" style="font-size: 0.85rem; color: #010101;">@lang('miscellaneous.phone_code')</small><br>
                                                        <span class="text-value">xxxx</span> 
                                                    </span>

                                                    <div class="form-floating">
                                                        <input type="hidden" id="phone_code1" name="phone_code_new_member" value="">
                                                        <input type="tel" name="phone_number_new_member" id="phone_number_new_member" class="form-control" placeholder="@lang('miscellaneous.phone')" aria-describedby="phone_error_message" required>
                                                        <label for="phone_number_new_member">@lang('miscellaneous.phone')</label>
                                                    </div>
                                                </div>
                                            </div>

    @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                                            <div class="col-12">
                                                <p id="phone_error_message" class="text-center mb-4 text-danger small">{{ $response_error->data }}</p>
                                            </div>
    @endif
                                        </div>
                                    </div>
    
                                    <div class="col-12 text-center">
                                        <button class="btn acr-btn-yellow btn-sm-inline-block btn-block rounded-pill mb-4 py-3 px-5 shadow-0" type="submit">@lang('miscellaneous.public.home.register_member.register')</button>

                                        <a href="{{ route('login') }}">@lang('miscellaneous.go_login')</a>
                                    </div>
                                </div>
    
                            </form>
    @endif

    @if(Route::is('update'))
                            <form method="POST" action="{{ route('update') }}">
        @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">{{ __('miscellaneous.register_title2') }}</h3>

                                <!-- First name -->
                                <div class="form-floating">
                                    <input type="text" name="register_firstname" id="register_firstname" class="form-control" autofocus />
                                    <label class="form-label" for="register_firstname">@lang('miscellaneous.firstname')</label>
                                </div>

                                <!-- Last name -->
                                <div class="form-floating">
                                    <input type="text" name="register_lastname" id="register_lastname" placeholder="@lang('miscellaneous.lastname')" class="form-control" />
                                    <label class="form-label" for="register_lastname">@lang('miscellaneous.lastname')</label>
                                </div>

                                <!-- Last name -->
                                <div class="form-floating">
                                    <input type="text" name="register_lastname" id="register_lastname" placeholder="@lang('miscellaneous.lastname')" class="form-control" />
                                    <label class="form-label" for="register_lastname">@lang('miscellaneous.lastname')</label>
                                </div>

                                <!-- Password -->
                                <div class="form-floating mt-4">
                                    <input type="password" name="register_password" id="register_password" class="form-control" placeholder="@lang('miscellaneous.password.label')" aria-describedby="password_error_message" {{ !empty($response_error) AND $response_error->message == $inputs['register_password'] ? 'autofocus' : '' }} />
                                    <label class="form-label" for="register_password">@lang('miscellaneous.password.label')</label>
                                </div>
        @if (!empty($response_error) AND $response_error->message == $inputs['password'])
                                <p id="password_error_message" class="text-center mb-4 text-danger small">{{ $response_error->data }}</p>

                                <!-- Confirm password -->
                                <div class="form-floating mb-3">
        @else
                                <!-- Confirm password -->
                                <div class="form-floating mt-4">
        @endif
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="@lang('miscellaneous.confirm_password.label')" aria-describedby="confirm_password_error_message" {{ !empty($response_error) AND $response_error->message == $inputs['confirm_password'] ? 'autofocus' : '' }} />
                                    <label class="form-label" for="confirm_password">@lang('miscellaneous.confirm_password.label')</label>
                                </div>
        @if (!empty($response_error) AND $response_error->message == $inputs['confirm_password'])
                                <p id="confirm_password_error_message" class="text-center mb-4 text-danger small">{{ $response_error->data }}</p>
        @endif

                                <!-- Run login -->
                                <button type="submit" class="btn acr-btn-blue btn-block py-3 mb-4 shadow-0">@lang('miscellaneous.register')</button>
                            </form>
    @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register block End -->
@endsection
