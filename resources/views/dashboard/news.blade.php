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
                            <div class="col-lg-5 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 p-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.info.' . $entity . '.add')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Infos list ==================== -->
                            <div class="col-lg-7 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 pB-10 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.info.' . $entity . '.title')</h6>
                                        </div>

                                        <div class="layer w-100 py-20">
                                            <div class="table-responsive p-20">
                                                <table id="dataList" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="bdwT-0 fw-bold"></th>
                                                            <th class="bdwT-0 fw-bold">#</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
        @if ($entity == 'news')
            @forelse ($news as $news_item)
                                                        <tr>
                                                            <td>
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
                                                                        <h5 class="h5 m-0 fw-bolder text-truncate">{{ $news_item->news_title }}</h5>
                                                                        <p class="mb-3 text-truncate">{{ $news_item->news_content }}</p>
                                                                        <small class="m-0 small text-muted text-truncate">{{ $news_item->created_at }}</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a role="button" class="btn btn-transparent p-0 fs-4 text-danger shadow-0" title="@lang('miscellaneous.delete')" onclick="event.preventDefault();deletemsg({{$news_item->id}},'../api/info');">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
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
