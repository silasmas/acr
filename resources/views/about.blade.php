@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
    @if (Route::is('about.home'))        
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .6), rgba(45, 62, 88, 0.6)), url({{ asset('assets/img/gallery/gallery-8.png') }}) top center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.title')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.menu.public.about')</li>
                    </ol>
                </nav>
            </div>
        </div>
    @endif

        <!-- Page Header End -->

        <!-- About Start -->
        <div class="container-xxl py-4">
            <div class="container">
                <div class="row g-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="row g-2">
                            <div class="col-6 position-relative wow fadeIn" data-wow-delay="0.7s">
                                <div class="about-experience acr-bg-yellow-transparent p-4 rounded text-center">
                                    <h1 class="display-3 fw-bold mb-1">
                                        <span class="acr-text-red-2">A</span><span class="acr-text-yellow">C</span><span class="acr-text-blue">R</span>
                                    </h1>
                                    <p class="acr-line-height-1_4 m-0">@lang('miscellaneous.public.about.slogan')</p>
                                </div>
                            </div>
                            <div class="col-6 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-1.png') }}">
                            </div>
                            <div class="col-6 wow fadeInUp" data-wow-delay="0.3s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-2.png') }}">
                            </div>
                            <div class="col-6 wow fadeInUp" data-wow-delay="0.5s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-3.png') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <h5 class="section-title bg-white text-start acr-text-red-2 my-4 pe-3">@lang('miscellaneous.public.about.title')</h5>
                        <h1 class="mb-4">@lang('miscellaneous.public.about.subtitle')</h1>
                        <p class="mb-3">@lang('miscellaneous.public.about.description')</p>

                        <div class="row g-5 mb-5">
                            <div class="col-sm-6">
                                <i class="bi bi-sun fs-1 acr-text-red-1"></i>
                                <h5 class="mb-3 fw-bold">@lang('miscellaneous.public.about.comment.title1')</h5>
                                <p class="m-0 small">@lang('miscellaneous.public.about.comment.content1')</p>
                            </div>
                            <div class="col-sm-6">
                                <i class="bi bi-people fs-1 acr-text-red-1"></i>
                                <h5 class="mb-3 fw-bold">@lang('miscellaneous.public.about.comment.title2')</h5>
                                <p class="m-0 small">@lang('miscellaneous.public.about.comment.content2')</p>
                            </div>
                        </div>

                        <a class="btn btn-secondary rounded-pill py-3 px-5" href="{{ route('about.home') }}">@lang('miscellaneous.see_more')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Why Us Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="section-title bg-white text-start acr-text-blue mb-4 pe-3">@lang('miscellaneous.public.about.why_us.title')</h5>
                        <h1 class="mb-4">@lang('miscellaneous.public.about.why_us.subtitle')</h1>
                        <p class="mb-4">@lang('miscellaneous.public.about.why_us.content')</p>
                        <p><i class="fa fa-check acr-text-blue me-3"></i><strong>@lang('miscellaneous.public.about.why_us.item1')</strong>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.about.why_us.item1_description')</p>
                        <p><i class="fa fa-check acr-text-blue me-3"></i><strong>@lang('miscellaneous.public.about.why_us.item2')</strong>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.about.why_us.item2_description')</p>
                        <p><i class="fa fa-check acr-text-blue me-3"></i><strong>@lang('miscellaneous.public.about.why_us.item3')</strong>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.about.why_us.item3_description')</p>
                        <a class="btn btn-secondary rounded-pill py-3 px-5 mt-3" href="{{ route('about.home') }}">@lang('miscellaneous.see_more')</a>
                    </div>

                    <div class="col-lg-6">
                        <div class="rounded overflow-hidden">
                            <div class="row g-0">
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="text-center acr-bg-blue-transparent py-5 px-4">
                                        <img class="mb-4 opacity-75" src="{{ asset('assets/img/about/motto-1.png') }}" alt="@lang('miscellaneous.public.about.why_us.item1')" width="90">
                                        <p class="m-0 fs-5 fw-semi-bold acr-text-blue text-uppercase">@lang('miscellaneous.public.about.why_us.item1')</p>
                                    </div>
                                </div>

                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="text-center acr-bg-blue py-5 px-4">
                                        <img class="mb-4 opacity-75" src="{{ asset('assets/img/about/motto-2.png') }}" alt="@lang('miscellaneous.public.about.why_us.item2')</" width="90">
                                        <p class="m-0 fs-5 fw-semi-bold text-white text-uppercase">@lang('miscellaneous.public.about.why_us.item2')</p>
                                    </div>
                                </div>

                                <div class="col-sm-6"></div>
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="text-center acr-bg-blue-transparent py-5 px-4">
                                        <img class="mb-4 opacity-75" src="{{ asset('assets/img/about/motto-3.png') }}" alt="@lang('miscellaneous.public.about.why_us.item3')</" width="90">
                                        <p class="m-0 fs-5 fw-semi-bold acr-text-blue text-uppercase">@lang('miscellaneous.public.about.why_us.item3')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Why Us End -->
@endsection
