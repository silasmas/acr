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
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->

@endsection
