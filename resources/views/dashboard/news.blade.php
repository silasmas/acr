@extends('layouts.app')

@section('app-content')

                        <div class="row gap-20">
    @if (Route::is('party.infos'))
                            <!-- #Recent news ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 pX-20 pT-20">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_news.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($news as $news_item)
            @if ($loop->index < 7)
                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'news', 'id' => $news_item->id]) }}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-1 col-3">
                @if (!empty($news_item->photo_url))
                                                            <div class="bg-image">
                                                                <img src="{{ $news_item->photo_url }}" alt="{{ $news_item->news_title }}" class="img-fluid rounded-3">
                                                                <div class="mask"></div>
                                                            </div>
                @else
                                                            <div class="d-flex justify-content-center h-100 align-items-center acr-bg-gray">
                                                                <span class="bi bi-image"></span>
                                                            </div>
                @endif
                                                        </div>
                                                        <div class="col-lg-10 col-md-11 col-9">
                                                            <h5 class="h5 m-0 fw-bold text-truncate">{{ $news_item->news_title }}</h5>
                                                            <p class="text-muted text-truncate">{{ $news_item->news_content }}</p>
                                                        </div>
                                                    </div>
                                                </a>
            @endif
        @empty
                                                <span class="list-group-item">@lang('miscellaneous.empty_list')</span>
        @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-20">
                                        <a href="{{ route('party.infos.entity', ['entity' => 'news']) }}">@lang('miscellaneous.manager.home.recent_news.link')</a>
                                    </div>
                                </div>
                            </div>

                            <!-- #Recent communiques ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 pX-20 pT-20">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_communiques.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($communiques as $communique)
            @if ($loop->index < 7)
                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'communique', 'id' => $communique->id]) }}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-1 col-3">
                @if (!empty($communique->photo_url))
                                                            <div class="bg-image">
                                                                <img src="{{ $communique->photo_url }}" alt="{{ $communique->news_title }}" class="img-fluid rounded-3">
                                                                <div class="mask"></div>
                                                            </div>
                @else
                                                            <div class="d-flex justify-content-center h-100 align-items-center acr-bg-gray">
                                                                <span class="bi bi-image"></span>
                                                            </div>
                @endif
                                                        </div>
                                                        <div class="col-lg-10 col-md-11 col-9">
                                                            <h5 class="h5 m-0 fw-bold text-truncate">{{ $communique->news_title }}</h5>
                                                            <p class="text-muted text-truncate">{{ $communique->news_content }}</p>
                                                        </div>
                                                    </div>
                                                </a>
            @endif
        @empty
                                                <span class="list-group-item">@lang('miscellaneous.empty_list')</span>
        @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-20">
                                        <a href="{{ route('party.infos.entity', ['entity' => 'communique']) }}">@lang('miscellaneous.manager.home.recent_communiques.link')</a>
                                    </div>
                                </div>
                            </div>

                            <!-- #Recent events ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 pX-20 pT-20">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_events.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($events as $event)
            @if ($loop->index < 7)
                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'event', 'id' => $event->id]) }}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-1 col-3">
                @if (!empty($event->photo_url))
                                                            <div class="bg-image">
                                                                <img src="{{ $event->photo_url }}" alt="{{ $event->news_title }}" class="img-fluid rounded-3">
                                                                <div class="mask"></div>
                                                            </div>
                @else
                                                            <div class="d-flex justify-content-center h-100 align-items-center acr-bg-gray">
                                                                <span class="bi bi-image"></span>
                                                            </div>
                @endif
                                                        </div>
                                                        <div class="col-lg-10 col-md-11 col-9">
                                                            <h5 class="h5 m-0 fw-bold text-truncate">{{ $event->news_title }}</h5>
                                                            <p class="text-muted text-truncate">{{ $event->news_content }}</p>
                                                        </div>
                                                    </div>
                                                </a>
            @endif
        @empty
                                                <span class="list-group-item">@lang('miscellaneous.empty_list')</span>
        @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-20">
                                        <a href="{{ route('party.infos.entity', ['entity' => 'event']) }}">@lang('miscellaneous.manager.home.recent_events.link')</a>
                                    </div>
                                </div>
                            </div>

    @else
                            <!-- #Add an info ==================== -->
                            <div class="col-lg-5 col-md-7 col-12 mx-auto">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 p-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.info.' . $entity . '.add')</h6>
                                        </div>

                                        <div class="layer w-100 p-20">
                                            <form method="POST" action="{{ route('party.infos.new') }}">
                                                <input type="hidden" name="type_id" value="{{ $entity_id }}">

                                                <!-- Title -->
                                                <label for="register_title" class="form-label mb-1 visually-hidden">@lang('miscellaneous.manager.info.news.data.title')</label>
                                                <input type="text" name="register_title" id="register_title" class="form-control mb-3" placeholder="@lang('miscellaneous.manager.info.news.data.title')" autofocus>

                                                <!-- Content -->
                                                <label for="register_content" class="form-label mb-1 visually-hidden">@lang('miscellaneous.manager.info.news.data.content')</label>
                                                <textarea name="register_content" id="register_content" class="form-control mb-3" placeholder="@lang('miscellaneous.manager.info.news.data.content')" required></textarea>

                                                <!-- Add photo -->
                                                <div id="addPicture" class="row">
                                                    <div class="col-md-7 col-8 mx-auto">
                                                        <div class="bg-image rounded overflow-hidden overlay mb-3">
                                                            <img src="{{ asset('assets/img/blank-news.png') }}" alt="@lang('miscellaneous.manager.info.news.data.add_photo')" class="news-image img-fluid">
                                                            <div class="mask h-100">
                                                                <label role="button" for="picture" class="d-flex justify-content-center align-items-center h-100 fs-6 text-black text-uppercase">
                                                                    <span>@lang('miscellaneous.manager.info.news.data.add_photo')</span>
                                                                    <input type="file" name="picture" id="picture" class="d-none">
                                                                </label>
                                                                <input type="hidden" name="data_picture" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Title -->
                                                <label for="register_title" class="form-label mb-1 visually-hidden">@lang('miscellaneous.manager.info.news.data.video_url')</label>
                                                <input type="text" name="register_title" id="register_title" class="form-control mb-3" placeholder="@lang('miscellaneous.manager.info.news.data.video_url')">

                                                <button type="submit" class="btn btn-block btn-primary btn-color mb-2 rounded-pill shadow-0">@lang('miscellaneous.register')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Infos list ==================== -->
                            <div class="col-lg-7">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 pB-10 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.info.' . $entity . '.title')</h6>
                                        </div>

                                        <div class="layer w-100 py-20">
                                            <div class="table-responsive pX-20 pT-20 pB-10">
                                                <table id="dataList" class="table">
                                                    <thead class="border-bottom border-default">
                                                        <tr>
                                                            <th class="bdwT-0 fw-bold"></th>
                                                            <th class="bdwT-0 fw-bold"></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
        @if ($entity == 'news')
            @forelse ($news as $news_item)
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-2 d-sm-inline-block d-none">
                                                                        <div class="bg-image mt-1">
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
                                                                        <h5 class="h5 mt-0 mb-1 fw-bold" style="font-family: Arial, Helvetica, sans-serif;">{{ strlen($news_item->news_title) > 35 ? substr($news_item->news_title, 0, 35)."..." : $news_item->news_title }}</h5>
                                                                        <p class="mb-1 acr-line-height-1_4 paragraph2">{{ strlen($news_item->news_content) > 100 ? substr($news_item->news_content, 0, 100)."..." : $news_item->news_content }}</p>
                                                                        <small class="m-0 small text-muted">{{ $news_item->created_at }}</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a role="button" class="btn btn-transparent p-0 fs-4 text-danger shadow-0" title="@lang('miscellaneous.delete')" data-bs-toggle="tooltip" onclick="event.preventDefault();deletemsg({{$news_item->id}},'../api/news');"><i class="fa fa-trash-o"></i></a><br>
                                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'news', 'id' => $news_item->id]) }}" class="btn btn-transparent p-0 fs-5 acr-text-blue shadow-0" title="@lang('miscellaneous.change')" data-bs-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                            </td>
                                                        </tr>
            @empty
            @endforelse
        @endif

        @if ($entity == 'communique')
            @forelse ($communiques as $communique)
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-2 d-sm-inline-block d-none">
                                                                        <div class="bg-image mt-1">
                                                                            <img src="{{ !empty($communique->photo_url) ? $communique->photo_url : asset('assets/img/blank-news.png') }}" alt="{{ $communique->news_title }}" class="img-fluid rounded-3">
                                                                            <div class="mask h-100">
                @if (empty($communique->photo_url))
                                                                                <div class="d-flex justify-content-center align-items-center h-100 fs-5 text-black text-uppercase">
                                                                                    <span class="bi bi-image text-secondary"></span>
                                                                                </div>

                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10 col-12">
                                                                        <h5 class="h5 mt-0 mb-1 fw-bold" style="font-family: Arial, Helvetica, sans-serif;">{{ strlen($communique->news_title) > 35 ? substr($communique->news_title, 0, 35)."..." : $communique->news_title }}</h5>
                                                                        <p class="mb-1 acr-line-height-1_4 paragraph2">{{ strlen($communique->news_content) > 100 ? substr($communique->news_content, 0, 100)."..." : $communique->news_content }}</p>
                                                                        <small class="m-0 small text-muted">{{ $communique->created_at }}</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a role="button" class="btn btn-transparent p-0 fs-4 text-danger shadow-0" title="@lang('miscellaneous.delete')" data-bs-toggle="tooltip" onclick="event.preventDefault();deletemsg({{$news_item->id}},'../api/news');"><i class="fa fa-trash-o"></i></a><br>
                                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'communique', 'id' => $communique->id]) }}" class="btn btn-transparent p-0 fs-5 acr-text-blue shadow-0" title="@lang('miscellaneous.change')" data-bs-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                            </td>
                                                        </tr>
            @empty
            @endforelse
        @endif

        @if ($entity == 'event')
            @forelse ($events as $event)
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-2 d-sm-inline-block d-none">
                                                                        <div class="bg-image mt-1">
                                                                            <img src="{{ !empty($event->photo_url) ? $event->photo_url : asset('assets/img/blank-news.png') }}" alt="{{ $event->news_title }}" class="img-fluid rounded-3">
                                                                            <div class="mask h-100">
                @if (empty($event->photo_url))
                                                                                <div class="d-flex justify-content-center align-items-center h-100 fs-5 text-black text-uppercase">
                                                                                    <span class="bi bi-image text-secondary"></span>
                                                                                </div>

                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10 col-12">
                                                                        <h5 class="h5 mt-0 mb-1 fw-bold" style="font-family: Arial, Helvetica, sans-serif;">{{ strlen($event->news_title) > 35 ? substr($event->news_title, 0, 35)."..." : $event->news_title }}</h5>
                                                                        <p class="mb-1 acr-line-height-1_4 paragraph2">{{ strlen($event->news_content) > 100 ? substr($event->news_content, 0, 100)."..." : $event->news_content }}</p>
                                                                        <small class="m-0 small text-muted">{{ $event->created_at }}</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a role="button" class="btn btn-transparent p-0 fs-4 text-danger shadow-0" title="@lang('miscellaneous.delete')" data-bs-toggle="tooltip" onclick="event.preventDefault();deletemsg({{$news_item->id}},'../api/news');"><i class="fa fa-trash-o"></i></a><br>
                                                                <a href="{{ route('party.infos.entity.datas', ['entity' => 'event', 'id' => $event->id]) }}" class="btn btn-transparent p-0 fs-5 acr-text-blue shadow-0" title="@lang('miscellaneous.change')" data-bs-toggle="tooltip"><i class="bi bi-pencil-square"></i></a>
                                                            </td>
                                                        </tr>
            @empty
            @endforelse
        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    @endif
                        </div>

@endsection
