@extends('layouts.auth')

@section('auth-content')

            <!-- Login block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-7">
                    <div class="card border border-default shadow-0">
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('password.phone') }}">
    @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">@lang('auth.reset-password')</h3>

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

                                <div class="input-group mt-3">
                                    <span id="phone_code_text1" class="input-group-text d-inline-block h-100 bg-light" style="padding-top: 0.3rem; padding-bottom: 0.5rem; line-height: 1.35;">
                                        <small class="text-secondary m-0 p-0" style="font-size: 0.85rem; color: #010101;">@lang('miscellaneous.phone_code')</small><br>
                                        <span class="text-value">xxxx</span> 
                                    </span>
                                    <div class="form-floating">
                                        <input type="hidden" id="phone_code1" name="phone_code" value="">
                                        <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="@lang('miscellaneous.phone')" aria-describedby="phone_error_message" required>
                                        <label for="phone_number">@lang('miscellaneous.phone')</label>
                                    </div>
                                </div>

    @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                                <p id="phone_error_message" class="text-center mt-2 text-danger small">{{ $response_error->data }}</p>
    @endif

                                <!-- Run or go login -->
                                <div class="row g-2 mt-3 text-center">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 shadow-0">@lang('miscellaneous.send')</button>
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
