@extends('layouts.auth')

@section('auth-content')

            <!-- Register block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-8">
                    <div class="card border border-default shadow-0">
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('register.check_token') }}">
        @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">{{ __('miscellaneous.register_title2') }}</h3>

                                <input type="hidden" name="user_token" value="{{ $user_token }}">

                                <div class="row">
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_1" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_2" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_3" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_4" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_5" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_6" class="form-control" autofocus>
                                    </div>
                                    <div class="col-1">
                                        <input type="text" name="check_digit_1" id="check_digit_7" class="form-control" autofocus>
                                    </div>
                                </div>

                                <button class="btn acr-btn-yellow btn-sm-inline-block btn-block rounded-pill mb-4 py-3 px-5 shadow-0" type="submit">@lang('miscellaneous.public.home.register_member.register')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register block End -->
@endsection
