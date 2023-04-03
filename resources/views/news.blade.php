@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .6), rgba(45, 62, 88, 0.6)), url({{ asset('assets/img/gallery/gallery-5.png') }}) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
    @if (Route::is('news.datas'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.news.details')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news.home') }}" class="acr-text-yellow">@lang('miscellaneous.public.news.title')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.news.details')</li>
                    </ol>
                </nav>
    @else
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.news.title')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.news.title')</li>
                    </ol>
                </nav>
    @endif

            </div>
        </div>
        <!-- Page Header End -->

    @if (Route::is('news.datas'))
        <!-- News details Start -->
        <div class="container-xxl py-4">
            <div class="container">
            </div>
        </div>
        <!-- News details End -->

    @else
        <!-- News list Start -->
        <div class="container-xxl py-4">
            <div class="container">
            </div>
        </div>
        <!-- News list End -->
    @endif

@endsection
