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

        <!-- Download App Start -->
        <div class="container-fluid banner my-5 py-4" style="background-color: rgba(0, 0, 0, 0.3);" data-parallax="scroll" data-image-src="{{ asset('assets/img/pubs/app-mobile.jpg') }}">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-7 col-sm-6 wow fadeIn text-sm-start text-center" data-wow-delay="0.3s">
                        <h1 class="h1 mb-4 fw-bold text-white">@lang('miscellaneous.public.about.download_mobile_app.title')</h1>
                        <p class="lead m-0 text-white">@lang('miscellaneous.public.about.download_mobile_app.content')</p>
                    </div>
                    <div class="col-lg-5 col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-image mb-4">
                            <img src="{{ asset('assets/img/button-playstore-white.png') }}" alt="" class="img-fluid">
                            <div class="mask"><a href="#" class="stretched-link"></a></div>
                        </div>

                        <div class="bg-image">
                            <img src="{{ asset('assets/img/button-applestore-white.png') }}" alt="" class="img-fluid">
                            <div class="mask"><a href="#" class="stretched-link"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Download App End -->

        <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Contact Us</p>
                <h1 class="mb-5">If You Have Any Query, Please Contact Us</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">Need a functional contact form?</h3>
                    <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 250px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary rounded-pill py-3 px-5" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h3 class="mb-4">Contact Details</h3>
                    <div class="d-flex border-bottom pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                            <i class="fa fa-map-marker-alt text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Our Office</h6>
                            <span>123 Street, New York, USA</span>
                        </div>
                    </div>
                    <div class="d-flex border-bottom pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                            <i class="fa fa-phone-alt text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Call Us</h6>
                            <span>+012 345 67890</span>
                        </div>
                    </div>
                    <div class="d-flex border-bottom-0 pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle">
                            <i class="fa fa-envelope text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Mail Us</h6>
                            <span>info@example.com</span>
                        </div>
                    </div>

                    <iframe class="w-100 rounded"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

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
