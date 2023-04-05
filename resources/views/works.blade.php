@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .8), rgba(45, 62, 88, 0.8)), url({{ asset('assets/img/gallery/gallery-6.png') }}) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.works.title')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.works.title')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- News list Start -->
        <div class="container-xxl py-4">
            <div class="container">
            </div>
        </div>
        <!-- News list End -->

@endsection
