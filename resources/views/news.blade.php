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
                <div class="row g-lg-5">
                    <!-- Current news -->
                    <div class="col-lg-8 mb-4 border-bottom border-default wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="h1 mb-4 fw-bold">{{ $news->news_title }}</h1>
        @if ($news->video_url != null)
                        <div class="ratio ratio-16x9 mb-4">
                            <iframe class="embed-responsive-item w-100" src="{{ $news->video_url }}" style="border-radius: 1.2rem;" allowfullscreen></iframe>
                        </div>
        @endif

        @if ($news->photo_url != null)
                        <div class="bg-image mb-4">
                            <img src="{{ !empty($news->photo_url) ? $news->photo_url : asset('assets/img/blank-news.png') }}" alt="{{ $news->news_title }}" class="img-fluid rounded-5">
                            <div class="mask"></div>
                        </div>
        @endif

                        <pre class="fs-5">
{{ $news->news_content }}
                        </pre>
                    </div>

                    <!-- Other news -->
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="h4 mb-4 fw-bold">{{ __('miscellaneous.public.news.other') }}</h4>
        @forelse ($other_news as $o_n)
            @if ($loop->index < 4 && $o_n->id != $news->id)
                        <div class="row mb-lg-4 mb-5">
                @if (!empty($o_n->photo_url))
                            <div class="col-lg-5 col-sm-4 col-12 mb-lg-0 mb-2">
                                <div class="bg-image">
                                    <img src="{{ !empty($o_n->photo_url) ? $o_n->photo_url : asset('assets/img/blank-news.png') }}" alt="{{ $o_n->news_title }}" class="img-fluid rounded-3">
                                    <div class="mask"></div>
                                </div>
                            </div>

                @endif
                            <div class="{{ !empty($o_n->photo_url) ? 'col-lg-7 col-sm-8 ' : '' }}col-12">
                                <a href="{{ route('news.datas', ['id' => $o_n->id]) }}">
                                    <small class="m-0 small" style="color: #999;">{{ $o_n->created_at }}</small>
                @if (!empty($o_n->news_title))
                                    <p class="m-0 fw-bold text-danger text-truncate">{{ $o_n->news_title }}</p>
                                    <p class="m-0 text-dark text-truncate">{{ $o_n->news_content }}</p>
                @else
                                    <p class="m-0 text-dark">{{ Str::limit($o_n->news_content, 45, '...') }}</p>
                @endif
                                    <a class="btn fw-bold py-2 ps-0 pe-3 border-bottom border-3 border-danger rounded-0 shadow-0" href="{{ route('news.datas', ['id' => $o_n->id]) }}">
                                        {{ __('miscellaneous.see_more') }}
                                    </a>
                                </a>
                            </div>
                        </div>
            @endif
        @empty
        @endforelse

        @if (count($other_news) == 1)
                        <p class="m-0 text">@lang('miscellaneous.empty_list')</p>
        @endif
                        <div class="row mt-5">
                            <div class="col-12">
                                <a class="btn acr-btn-yellow d-block shadow-0" href="{{ route('news.home') }}">{{ __('miscellaneous.back_list') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- News details End -->

    @else
        <!-- News list Start -->
        <div class="container-xxl py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive pX-20 pT-20 pB-10">
                            <table id="dataList" class="table">
                                <thead class="border-bottom border-default">
                                    <tr>
                                        <th class="bdwT-0 fw-bold"></th>
                                    </tr>
                                </thead>

                                <tbody>
        @forelse ($news as $news_item)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="bg-image mt-1 mb-sm-0 mb-4">
                                                        <img src="{{ !empty($news_item->photo_url) ? $news_item->photo_url : asset('assets/img/blank-news.png') }}" alt="{{ $news_item->news_title }}" class="img-fluid rounded-3">
                                                        <div class="mask h-100">
            @if (empty($news_item->photo_url))
                                                            <div class="d-flex justify-content-center align-items-center h-100 fs-5 text-black text-uppercase">
                                                                <span class="bi bi-image text-secondary"></span>
                                                            </div>
            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-12">
                                                    <h4 class="h4 m-0 text-pri fw-bold">{{ Str::limit($news_item->news_title, 35, '...') }}</h4>
                                                    <small class="mb-3 small text-muted">{{ $news_item->created_at }}</small>
                                                    <p class="mt-3 mb-2 text-black acr-line-height-1_45">{{ Str::limit($news_item->news_content, 150, '...') }}</p>
                                                    <p class="mb-2">
                                                        <a class="btn fw-bold py-2 ps-0 pe-3 border-bottom border-3 border-danger rounded-0 shadow-0" href="{{ route('news.datas', ['id' => $news_item->id]) }}">
                                                            {{ __('miscellaneous.see_more') }}
                                                        </a>
                                                    </p>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
        @empty
        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- News list End -->
    @endif

@endsection
