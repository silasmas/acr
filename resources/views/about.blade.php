@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
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
        <!-- Page Header End -->

        <!-- About party Start -->
        <div class="container-xxl py-4">
            <div class="container">
                <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-warning px-3">{{ $about_party->subject_name }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-9">
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
                        <h1 class="h1 mt-3 fw-bold">{{ $info_title->title }}</h1>

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
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @else
                        <div class="row">
                            <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
                                <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                            </div>
                        </div>
                @endif
            @endforeach                
        @endif
    @endforeach
                    </div>

                    <div class="col-lg-3">
                        <div class="card mb-4 border border-default shadow-0">
                            <div class="card-body">
                                <h4 class="h4 mb-4 text-black fw-bold">@lang('miscellaneous.public.about.other_links.title')</h4>

    @if (Route::is('about.home'))
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
    @endif

    @if (Route::is('about.terms_of_use'))
                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
    @endif

    @if (Route::is('about.privacy_policy'))
                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
    @endif

    @if (Route::is('about.help'))
                                <a href="{{ route('about.home') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.menu.public.about')</a>
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
    @endif

    @if (Route::is('about.faq'))
                                <a href="{{ route('about.terms_of_use') }}" class="btn btn-sm btn-primary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link1')</a>
                                <a href="{{ route('about.privacy_policy') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link2')</a>
                                <a href="{{ route('about.help') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link3')</a>
                                <a href="{{ route('about.faq') }}" class="btn btn-sm btn-secondary mb-3 py-2 rounded-pill shadow-0">@lang('miscellaneous.public.about.other_links.link4')</a>
    @endif

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
                        <p class="mb-4"><pre class="fw-light">{{ $info_content->content }}</pre></p>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-12 pe-2 wow fadeInUp" data-wow-delay="0.3s">
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
                            <div class="mask"><a href="#" class="stretched-link"></a></div>
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

@endsection
