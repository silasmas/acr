@extends('layouts.errors')

@section('errors-content')

        <div class="container-xxl py-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
    @if ($status_code == '0')
                        <h1 class="display-1 fw-bold text-success text-uppercase"><span class="bi bi-check-circle"></span></h1>
    @endif

    @if ($status_code == '1')
                        <h1 class="display-1 fw-bold text-warning text-uppercase"><span class="bi bi-exclamation-circle"></span></h1>
    @endif

    @if ($status_code == '2')
                        <h1 class="display-1 fw-bold text-danger text-uppercase"><span class="bi bi-x-circle"></span></h1>
    @endif
                        <h1 class="mb-4">{{ $message_content }}</h1>
                        <a href="{{ route('home') }}" class="btn d-lg-inline-block d-none acr-btn-yellow rounded-pill py-3 px-5">{{ __('miscellaneous.back_home') }}</a>
                    </div>
                </div>
            </div>
        </div>

@endsection
