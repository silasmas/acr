@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .6), rgba(45, 62, 88, 0.6)), url({{ asset('assets/img/gallery/gallery-8.png') }}) top center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
    @if (Route::is('about.home'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.title')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.menu.public.about')</li>
                    </ol>
                </nav>
    @endif

    @if (Route::is('about.terms_of_use'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.other_links.link1')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('about.home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.public.about')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.about.other_links.link1')</li>
                    </ol>
                </nav>
    @endif

    @if (Route::is('about.privacy_policy'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.other_links.link2')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('about.home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.public.about')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.about.other_links.link2')</li>
                    </ol>
                </nav>
    @endif

    @if (Route::is('about.help'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.other_links.link3')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('about.home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.public.about')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.about.other_links.link3')</li>
                    </ol>
                </nav>
    @endif

    @if (Route::is('about.faq'))
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.public.about.other_links.link4')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('about.home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.public.about')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.public.about.other_links.link4')</li>
                    </ol>
                </nav>
    @endif

            </div>
        </div>
        <!-- Page Header End -->

    @if (Route::is('about.home'))
        <!-- About party Start -->
        <div class="container-xxl py-4">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-warning px-3">{{ $about_party->subject_name }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <p><pre class="fs-5">{{ $about_party->subject_description }}</pre></p>

                        <hr class="my-4">

        @foreach ($about_party->legal_info_titles as $info_title)
            @if ($info_title->title == 'Les cadres du parti')
                        <div class="row py-4">
                @foreach ($info_title->legal_info_contents as $info_content)
                            <div class="col-lg-5 col-md-6 col-12 mx-auto mb-3 pe-2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item p-4 border border-default rounded shadow-0">
                                    <img class="img-fluid rounded mb-4" src="{{ $info_content->photo_url != null ? $info_content->photo_url : asset('assets/img/user.png') }}" alt="">
                                    <h5 class="text-black fw-bold">{{ $info_content->subtitle }}</h5>
                                    <p class="m-0 acr-line-height-1_4"><small class="m-0 small text-muted">{{ $info_content->content }}</small></p>
                                </div>
                            </div>
                @endforeach
                        </div>

            @else
                        <h2 class="h2 mt-3 fw-bold">{{ $info_title->title }}</h2>

                @foreach ($info_title->legal_info_contents as $info_content)
                    @if ($info_content->photo_url != null)
                        <div class="row">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="bg-image">
                                    <img src="{{ $info_content->photo_url }}" alt="{{ $info_title->title }}" class="img-fluid rounded">
                                    <div class="mask"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pe-2 wow fadeInUp" data-wow-delay="0.5s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                    @endif
                @endforeach                
            @endif
        @endforeach
                    </div>

                    <div class="col-lg-3">
                        <div class="card my-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About party End -->

        <!-- About app Start -->
        <div class="container-xxl py-5 border-top border-bottom border-default">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white acr-text-red-2 px-3">{{ $about_app->subject_name }}</p>
                </div>

                <p><pre class="fs-5">{{ $about_app->subject_description }}</pre></p>

                <hr class="my-4">

        @foreach ($about_app->legal_info_titles as $info_title)
            @if ($info_title->title == 'Avantages d\'utiliser notre appli mobile')
                <h1 class="h1 my-4 fw-bold">{{ $info_title->title }}</h1>

                @foreach ($info_title->legal_info_contents as $info_content)
                <ul>
                    <li class="wow fadeInUp" data-wow-delay="0.1s">
                        <h4 class="h4 m-0 fw-bold">{{ $info_content->subtitle }}</h4>
                        <p class="mb-3"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                    </li>
                </ul>
                @endforeach
            @else
                <h1 class="mt-3 fw-bold">{{ $info_title->title }}</h1>

                @foreach ($info_title->legal_info_contents as $info_content)
                    @if ($info_content->photo_url != null)
                <div class="row">
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="bg-image">
                            <img src="{{ $info_content->photo_url }}" alt="{{ $info_title->title }}" class="img-fluid rounded">
                            <div class="mask"></div>
                        </div>
                    </div>
                    <div class="col-md-6 pe-2 wow fadeInUp" data-wow-delay="0.5s">
                        <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                        <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                    </div>
                </div>
                    @else
                <div class="row">
                    <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                        <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                    </div>
                </div>
                    @endif
                @endforeach
            @endif
        @endforeach
                <div class="row mt-5">
                    <div class="col-lg-4 col-sm-6">
                        <div class="bg-image mb-4">
                            <img src="{{ asset('assets/img/button-playstore-white.png') }}" alt="" class="img-fluid">
                            <div class="mask"><a href="{{ asset('mobile_app/acr-rdc-v1_0_0.apk') }}" class="stretched-link"></a></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="bg-image">
                            <img src="{{ asset('assets/img/button-applestore-white.png') }}" alt="" class="img-fluid">
                            <div class="mask"><a href="#" class="stretched-link"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
    @endif

    @if (Route::is('about.terms_of_use'))
        <!-- Terms Of Use Start -->
        <div class="container-xxl py-4 border-bottom border-default">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-warning px-3">{{ $terms->subject_name }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <p><pre class="fs-5">{{ $terms->subject_description }}</pre></p>

                        <hr class="my-4">

        @foreach ($terms->legal_info_titles as $info_title)
                        <h2 class="h2 mt-3 fw-bold">{{ $info_title->title }}</h2>

            @foreach ($info_title->legal_info_contents as $info_content)
                @if ($info_content->photo_url != null)
                        <div class="row">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="bg-image">
                                    <img src="{{ $info_content->photo_url }}" alt="{{ $info_title->title }}" class="img-fluid rounded">
                                    <div class="mask"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pe-2 wow fadeInUp" data-wow-delay="0.5s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @else
                        <div class="row">
                            <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @endif
            @endforeach                
        @endforeach
                    </div>

                    <div class="col-lg-3">
                        <div class="card my-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill text-white shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Terms Of Use End -->
    @endif

    @if (Route::is('about.privacy_policy'))
        <!-- Privacy policy Start -->
        <div id="privacyPolicy" class="container-xxl py-3 border-bottom border-default">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <!-- Subtitle -->
                        <div class="mb-5 wow fadeInUp" data-wow-delay="0.1s">
                            <h4 class="h4 text-black fw-bold">@lang('miscellaneous.public.privacy_policy.subtitle')</h4>
                            <p class="m-0 small">@lang('miscellaneous.public.privacy_policy.last_updated')</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-5">
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.description.paragraph1')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.description.item1')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.description.item2')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.description.item3')</li>
                            </ul>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.description.paragraph2')</p>
                        </div>

                        <!-- Summary of key points -->
                        <div class="mb-5">
                            <h4 class="h4 fw-bold wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.title')</h4>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph02')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph03')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph04')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph05')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph06')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph07')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph08')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph09')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.key_point_summary.paragraph10')</p>
                        </div>

                        <!-- Table of content -->
                        <div class="card mb-4 border border-default shadow-0 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-body">
                                <h4 class="h4 mb-4 fw-bold">@lang('miscellaneous.public.privacy_policy.table_of_content.title')</h4>

                                <ul id="toc">
                                    <li style="list-style-type: decimal;"><a href="#toc_item01" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item01')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item02" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item02')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item03" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item03')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item04" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item04')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item05" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item05')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item06" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item06')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item07" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item07')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item08" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item08')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item09" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item09')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item10" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item10')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item11" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item11')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item12" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item12')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item13" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item13')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item14" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item14')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item15" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item15')</a></li>
                                    <li style="list-style-type: decimal;"><a href="#toc_item16" class="text-dark">@lang('miscellaneous.public.privacy_policy.table_of_content.item16')</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item01" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                1. @lang('miscellaneous.public.privacy_policy.table_of_content.item01') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <h6 class="h6 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">1.1. @lang('miscellaneous.public.privacy_policy.item01.content01')</h6>
                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item01.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph01')</p>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item03')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item04')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item05')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item06')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item07')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item08')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item09')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph02.item10')</li>
                            </ul>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph03.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph03.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph03.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph03.item03')</li>
                            </ul>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph04')</p>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph05.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph05.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph05.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph05.item03')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph05.item04')</li>
                            </ul>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph06')</p>
                            <p class="mb-5 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph07')</p>

                            <h6 class="h6 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">1.2. @lang('miscellaneous.public.privacy_policy.item01.content02')</h6>
                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item01.in_short_content02')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph08')</p>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph09.content')</p>
                            <ul class="mb-5">
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph09.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph09.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph09.item03')</li>
                            </ul>

                            <h6 class="h6 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">1.3. @lang('miscellaneous.public.privacy_policy.item01.content03')</h6>
                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item01.in_short_content03')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item01.paragraph10')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item02" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                2. @lang('miscellaneous.public.privacy_policy.table_of_content.item02') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item02.in_short_content01')
                            </p>

                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item03')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item04')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item05')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item06')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item07')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item08')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item09')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item10')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item11')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item12')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item02.paragraph01.item13')</li>
                            </ul>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item03" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                3. @lang('miscellaneous.public.privacy_policy.table_of_content.item03') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item03.in_short_content01')
                            </p>

                            <h6 class="h6 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">3.1. @lang('miscellaneous.public.privacy_policy.item03.content01')</h6>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item02')</li>
                                <li>
                                    <span class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subcontent01')</span>

                                    <ul>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem01')</li>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem02')</li>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem03')</li>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem04')</li>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem05')</li>
                                        <li class="wow fadeInUp" data-wow-delay="0.3s" style="list-style-type: square;">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item03.subitem06')</li>
                                    </ul>
                                </li>
                                <li class="mt-2 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item04')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph01.item05')</li>
                            </ul>
                            <p class="mb-5 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph02')</p>

                            <h6 class="h6 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">3.2. @lang('miscellaneous.public.privacy_policy.item03.content02')</h6>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph03')</p>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item02')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item03')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item04')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item05')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item06')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item07')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item08')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item09')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item10')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item03.paragraph04.item11')</li>
                            </ul>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item04" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                4. @lang('miscellaneous.public.privacy_policy.table_of_content.item04') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item04.in_short_content01')
                            </p>

                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item04.paragraph01.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item04.paragraph01.item01')</li>
                            </ul>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item05" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                5. @lang('miscellaneous.public.privacy_policy.table_of_content.item05') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item05.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item05.paragraph01')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item06" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                6. @lang('miscellaneous.public.privacy_policy.table_of_content.item06') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item06.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item06.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item06.paragraph02')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item06.paragraph03')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item06.paragraph04')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item07" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                7. @lang('miscellaneous.public.privacy_policy.table_of_content.item07') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item07.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item07.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item07.paragraph02')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item08" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                8. @lang('miscellaneous.public.privacy_policy.table_of_content.item08') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item08.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item08.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item08.paragraph02')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item08.paragraph03')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item09" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                9. @lang('miscellaneous.public.privacy_policy.table_of_content.item09') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item09.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item09.paragraph01')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item10" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                10. @lang('miscellaneous.public.privacy_policy.table_of_content.item10') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item10.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph02')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph03')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph04')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph05')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph06')</p>

                            <h6 class="h6 mt-4 mb-2 fw-bold wow fadeInUp" data-wow-delay="0.3s"><i class="bi bi-pin-angle align-middle fs-4 acr-text-yellow"></i> @lang('miscellaneous.public.privacy_policy.item10.content01')</h6>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph07.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph07.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph07.item02')</li>
                            </ul>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph08')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph09')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item10.paragraph10')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item11" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                11. @lang('miscellaneous.public.privacy_policy.table_of_content.item11') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item11.paragraph01')</p>
                        </div>

                        <div class="my-5">
                            <h4 id="toc_item12" class="h4 mb-4 fw-bold wow fadeInUp" data-wow-delay="0.3s">
                                12. @lang('miscellaneous.public.privacy_policy.table_of_content.item12') 
                                <a href="#toc" title="@lang('miscellaneous.back_toc')"><i class="bi bi-arrow-up-short align-middle acr-text-blue"></i></a>
                            </h4>

                            <p class="fst-italic acr-line-height-1_4 wow fadeInUp" data-wow-delay="0.3s">
                                <i class="bi bi-chevron-double-right me-2 align-middle fs-4 text-danger"></i>
                                <u class="fw-bold">@lang('miscellaneous.public.privacy_policy.in_short')</u>@lang('miscellaneous.colon_after_word') @lang('miscellaneous.public.privacy_policy.item12.in_short_content01')
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph01')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph02')</p>

                            <h6 class="h6 mt-4 mb-2 fw-bold wow fadeInUp" data-wow-delay="0.3s"><i class="bi bi-pin-angle align-middle fs-4 acr-text-yellow"></i> @lang('miscellaneous.public.privacy_policy.item12.content01')</h6>
                            <p class="mb-1 wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph03.content')</p>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph03.item01')</li>
                                <li class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph03.item02')</li>
                            </ul>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph04')</p>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph05')</p>

                            <h6 class="h6 mt-4 mb-2 fw-bold wow fadeInUp" data-wow-delay="0.3s"><i class="bi bi-pin-angle align-middle fs-4 acr-text-yellow"></i> @lang('miscellaneous.public.privacy_policy.item12.content02')</h6>
                            <p class="wow fadeInUp" data-wow-delay="0.3s">@lang('miscellaneous.public.privacy_policy.item12.paragraph06')</p>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold">@lang('miscellaneous.public.privacy_policy.item12.table01.head.col01')</th>
                                            <th class="fw-bold">@lang('miscellaneous.public.privacy_policy.item12.table01.head.col02')</th>
                                            <th class="fw-bold">@lang('miscellaneous.public.privacy_policy.item12.table01.head.col03')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row01.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row01.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row01.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row02.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row02.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row02.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row03.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row03.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row03.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row04.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row04.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row04.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row05.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row05.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row05.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row06.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row06.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row06.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row07.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row07.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row07.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row08.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row08.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row08.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row09.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row09.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row09.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row10.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row10.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row10.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row11.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row11.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row11.col03')</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row12.col01')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row12.col02')</td>
                                            <td>@lang('miscellaneous.public.privacy_policy.item12.table01.row12.col03')</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card my-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill text-white shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Privacy policy End -->
    @endif

    @if (Route::is('about.help'))
        <!-- Help Start -->
        <div class="container-xxl py-4 border-bottom border-default">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-warning px-3">{{ $help->subject_name }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <p><pre class="fs-5">{{ $help->subject_description }}</pre></p>

                        <hr class="my-4">

        @foreach ($help->legal_info_titles as $info_title)
                        <h2 class="h2 mt-3 fw-bold">{{ $info_title->title }}</h2>

            @foreach ($info_title->legal_info_contents as $info_content)
                @if ($info_content->photo_url != null)
                        <div class="row">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="bg-image">
                                    <img src="{{ $info_content->photo_url }}" alt="{{ $info_title->title }}" class="img-fluid rounded">
                                    <div class="mask"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pe-2 wow fadeInUp" data-wow-delay="0.5s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @else
                        <div class="row">
                            <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @endif
            @endforeach                
        @endforeach
                    </div>

                    <div class="col-lg-3">
                        <div class="card my-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill text-white shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Help End -->
    @endif

    @if (Route::is('about.faq'))
        <!-- FAQ Start -->
        <div class="container-xxl py-4 border-bottom border-default">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-warning px-3">{{ $faq->subject_name }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <p><pre class="fs-5">{{ $faq->subject_description }}</pre></p>

                        <hr class="my-4">

        @foreach ($faq->legal_info_titles as $info_title)
                        <h2 class="h2 mt-3 fw-bold">{{ $info_title->title }}</h2>

            @foreach ($info_title->legal_info_contents as $info_content)
                @if ($info_content->photo_url != null)
                        <div class="row">
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="bg-image">
                                    <img src="{{ $info_content->photo_url }}" alt="{{ $info_title->title }}" class="img-fluid rounded">
                                    <div class="mask"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pe-2 wow fadeInUp" data-wow-delay="0.5s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @else
                        <div class="row">
                            <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                                <h4 class="h4 mt-3 fw-bold">{{ $info_content->subtitle }}</h4>
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @endif
            @endforeach                
        @endforeach
                    </div>

                    <div class="col-lg-3">
                        <div class="card my-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill text-white shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ End -->
    @endif

@endsection
