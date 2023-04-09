@extends('layouts.errors')

@section('errors-content')

        <div class="container-xxl py-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
    @if ($status_code == '0')
                        <h1 class="text-success" style="font-size: 5rem;"><span class="bi bi-check-circle"></span></h1>
    @endif

    @if ($status_code == '1')
                        <h1 class="text-warning" style="font-size: 5rem;"><span class="bi bi-exclamation-circle"></span></h1>
    @endif

    @if ($status_code == '2')
                        <h1 class="text-danger" style="font-size: 5rem;"><span class="bi bi-x-circle"></span></h1>
    @endif
                        <h3 class="h3 mb-4">{{ $message_content }}</h3>
                        <a href="{{ route('home') }}" class="btn d-lg-inline-block d-none acr-btn-yellow rounded-pill py-3 px-5">{{ __('miscellaneous.back_home') }}</a>
                    </div>
                </div>
            </div>
        </div>

@endsection
