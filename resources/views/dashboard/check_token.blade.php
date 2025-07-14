@extends('layouts.app')

@section('app-content')
                        <div class="row gap-20">
                            <div class="masonry-sizer col-lg-12"></div>

                            <!-- #Members list ==================== -->
                            <div class="masonry-item col-lg-6 col-md-8 mx-auto">
                                <div class="layers bd bgc-white p-10">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1 m-0">@lang('miscellaneous.register_title3')</h6>
                                    </div>

                                    <div class="layer w-100 pX-20 pT-10 pB-20">
                                        <form action="{{ route('party.member.new.check_token') }}" method="POST">
    @csrf
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
            
                                            <button class="btn btn-block btn-primary btn-color rounded-pill shadow-0" type="submit">@lang('miscellaneous.public.home.register_member.register')</button>

    @if (!empty($error_message))
                                            <p class="mt-4 mb-0 text-center text-danger small">{{ $error_message }}</p>
    @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
