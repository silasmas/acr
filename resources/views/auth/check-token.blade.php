@extends('layouts.auth')

@section('auth-content')

            <!-- Check token block Start -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-8">
                    <div class="card border border-default shadow-0">
    @if (!empty($response_error))
                        <div class="card-body py-5">
                            <h1>{{ $response_error->message }}</h1>
                        </div>
    @else
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('register.check_token') }}">
        @csrf
                                <h3 class="h3 mb-sm-5 mb-4 text-center fw-bold">{{ __('miscellaneous.register_title3') }}</h3>

                                <input type="hidden" name="phone" value="{{ $phone }}">
                                <input type="hidden" name="password" value="{{ $password }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="row mb-4">
                                    <div class="col-sm-8 mx-auto">
                                        <div class="d-flex">
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_1" id="check_digit_1" class="form-control text-center" autofocus onkeyup="mFunc('check_digit_1')">
                                            </div>
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_2" id="check_digit_2" class="form-control text-center" onkeyup="mFunc('check_digit_2')">
                                            </div>
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_3" id="check_digit_3" class="form-control text-center" onkeyup="mFunc('check_digit_3')">
                                            </div>
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_4" id="check_digit_4" class="form-control text-center" onkeyup="mFunc('check_digit_4')">
                                            </div>
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_5" id="check_digit_5" class="form-control text-center" onkeyup="mFunc('check_digit_5')">
                                            </div>
                                            <div class="flex-fill me-1">
                                                <input type="text" name="check_digit_6" id="check_digit_6" class="form-control text-center" onkeyup="mFunc('check_digit_6')">
                                            </div>
                                            <div class="flex-fill">
                                                <input type="text" name="check_digit_7" id="check_digit_7" class="form-control text-center" onkeyup="mFunc('check_digit_7')">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn acr-btn-yellow btn-sm-inline-block btn-block rounded-pill mb-4 py-3 px-5 shadow-0" type="submit">@lang('miscellaneous.public.home.register_member.register')</button>

        @if (!empty($error_message))
                                <p class="text-center m-0 text-danger small">{{ $error_message }}</p>
        @endif
                            </form>
                        </div>
    @endif
                    </div>
                </div>
            </div>
            <!-- Check token block End -->

            <script type="text/javascript">
                function mFunc(id) {
                    var _val = document.getElementById(id).value;
                    var _splitId = id.split('_');
                    var key = event.keyCode || event.charCode;

                    if (key === 8 || key === 46 || key === 37) {
                        if (_splitId[2] !== '1') {
                            var previousElement = document.getElementById('check_digit_' + (parseInt(_splitId[2]) - 1));

                            previousElement.focus();
                        }

                    } else {
                        var nextElement = document.getElementById('check_digit_' + (parseInt(_splitId[2]) + 1));

                        if (key === 39) {
                            nextElement.focus();
                        }

                        if (_splitId[2] !== '7') {
                            if (_val !== undefined && Number.isInteger(parseInt(_val))) {
                                nextElement.focus();
                            }
                        }
                    }
                }
            </script>

@endsection
