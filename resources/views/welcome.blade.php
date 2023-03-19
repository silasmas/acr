@extends('layouts.guest')

@section('guest-content')

        <!-- Carousel Start -->
        <div class="container-fluid px-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="bg-image">
                            <img class="w-100" src="{{ asset('assets/img/slides/slide-1.png') }}" alt="">
                            <div class="mask" style="background: linear-gradient(45deg, hsla(202, 95%, 34%, 0.5), hsla(0, 0%, 0%, 0.5) 100%);"></div>
                        </div>
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-lg-start justify-content-center">
                                    <div class="col-lg-8 text-lg-start text-center">
                                        <p class="fs-4 text-white">@lang('miscellaneous.public.home.slide1.title')</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">@lang('miscellaneous.public.home.slide1.content')</h1>
                                        <a href="" class="btn btn-light rounded-pill py-3 px-5 shadow-0 animated slideInRight">@lang('miscellaneous.see_more')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="bg-image">
                            <img class="w-100" src="{{ asset('assets/img/slides/slide-2.png') }}" alt="">
                            <div class="mask" style="background: linear-gradient(45deg, hsla(0, 0%, 0%, 0.5), hsla(202, 95%, 34%, 0.5) 100%);"></div>
                        </div>
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-lg-end justify-content-center">
                                    <div class="col-lg-8 text-lg-end text-center">
                                        <p class="fs-4 text-white">@lang('miscellaneous.public.home.slide2.title')</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">@lang('miscellaneous.public.home.slide2.content')</h1>
                                        <a href="" class="btn btn-light rounded-pill py-3 px-5 shadow-0 animated slideInLeft">@lang('miscellaneous.see_more')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="bg-image">
                            <img class="w-100" src="{{ asset('assets/img/slides/slide-3.png') }}" alt="">
                            <div class="mask" style="background: linear-gradient(45deg, hsla(202, 95%, 34%, 0.5), hsla(0, 0%, 0%, 0.5) 100%);"></div>
                        </div>
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-lg-start justify-content-center">
                                    <div class="col-lg-8 text-lg-start text-center">
                                        <p class="fs-4 text-white">@lang('miscellaneous.public.home.slide3.title')</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">@lang('miscellaneous.public.home.slide3.content')</h1>
                                        <a href="" class="btn btn-light rounded-pill py-3 px-5 shadow-0 animated slideInRight">@lang('miscellaneous.see_more')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('pagination.previous')</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">@lang('pagination.next')</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->

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
                            <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-1.png') }}">
                            </div>
                            <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-2.png') }}">
                            </div>
                            <div class="col-6 wow fadeIn" data-wow-delay="0.5s">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about/about-3.png') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h5 class="section-title bg-white text-start text-primary my-4 pe-3">@lang('miscellaneous.public.about.title')</h5>
                        <h1 class="mb-4">@lang('miscellaneous.public.about.subtitle')</h1>
                        <p class="mb-3">@lang('miscellaneous.public.about.description')</p>

                        <div class="row g-5 mb-5">
                            <div class="col-sm-6">
                                <i class="bi bi-sun fs-1 text-info"></i>
                                <h5 class="mb-3 fw-bold">@lang('miscellaneous.public.about.comment.title1')</h5>
                                <p class="m-0 small">@lang('miscellaneous.public.about.comment.content1')</p>
                            </div>
                            <div class="col-sm-6">
                                <i class="bi bi-people fs-1 text-info"></i>
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

        <!-- Features Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="section-title bg-white text-start text-primary pe-3">@lang('miscellaneous.public.about.why_us.title')</p>
                        <h1 class="mb-4">@lang('miscellaneous.public.about.why_us.subtitle')</h1>
                        <p class="mb-4">@lang('miscellaneous.public.about.why_us.content')</p>
                        <p>
                            <i class="fa fa-check text-primary me-3"></i>@lang('miscellaneous.public.about.why_us.item1')
                        </p>
                        <p>
                            <i class="fa fa-check text-primary me-3"></i>@lang('miscellaneous.public.about.why_us.item2')
                        </p>
                        <p>
                            <i class="fa fa-check text-primary me-3"></i>@lang('miscellaneous.public.about.why_us.item3')
                        </p>
                        <a class="btn btn-secondary rounded-pill py-3 px-5 mt-3" href="{{ route('about.home') }}">@lang('miscellaneous.see_more')</a>
                    </div>

                    <div class="col-lg-6">
                        <div class="rounded overflow-hidden">
                            <div class="row g-0">
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="text-center bg-primary py-5 px-4">
                                        <img class="img-fluid mb-4" src="img/experience.png" alt="">
                                        <h1 class="display-6 text-white" data-toggle="counter-up">25</h1>
                                        <span class="fs-5 fw-semi-bold text-secondary">Years Experience</span>
                                    </div>
                                </div>

                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="text-center bg-secondary py-5 px-4">
                                        <img class="img-fluid mb-4" src="img/award.png" alt="">
                                        <h1 class="display-6" data-toggle="counter-up">183</h1>
                                        <span class="fs-5 fw-semi-bold text-primary">Award Winning</span>
                                    </div>
                                </div>

                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="text-center bg-secondary py-5 px-4">
                                        <img class="img-fluid mb-4" src="img/animal.png" alt="">
                                        <h1 class="display-6" data-toggle="counter-up">2619</h1>
                                        <span class="fs-5 fw-semi-bold text-primary">Total Animals</span>
                                    </div>
                                </div>

                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                    <div class="text-center bg-primary py-5 px-4">
                                        <img class="img-fluid mb-4" src="img/client.png" alt="">
                                        <h1 class="display-6 text-white" data-toggle="counter-up">51940</h1>
                                        <span class="fs-5 fw-semi-bold text-secondary">Happy Clients</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features End -->
@endsection
