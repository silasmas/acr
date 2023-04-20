@extends('layouts.app')

@section('app-content')

    @if ($current_user->role_user->role->role_name == 'Administrateur')
    @endif

    @if ($current_user->role_user->role->role_name == 'Développeur')
    @endif

    @if ($current_user->role_user->role->role_name == 'Manager')
                        <div class="row gap-20 masonry pos-r">
                            <div class="masonry-sizer col-md-6"></div>
                            <div class="masonry-item col-lg-6">
                                <div class="row gap-20">
                                    <!-- #All members ==================== -->
                                    <div class="col-md-6">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">@lang('miscellaneous.manager.home.total_membership')</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{ formatIntegerNumber(count($users_not_developer)) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- #Members who left ==================== -->
                                    <div class="col-md-6">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">@lang('miscellaneous.manager.home.members_who_left')</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash2"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{ formatIntegerNumber(count($deactivated_users)) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #New Members ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 pX-20 pT-20">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.new_members.title')</h6>
                                        </div>

                                        <div class="layer w-100">
                                            <div class="table-responsive p-20">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="bdwT-0 fw-bold">@lang('miscellaneous.names')</th>
                                                            <th class="bdwT-0 fw-bold">@lang('miscellaneous.phone')</th>
                                                            <th class="bdwT-0 fw-bold">@lang('miscellaneous.admin.miscellaneous.status.title')</th>
                                                            <th class="bdwT-0 fw-bold">#</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
        @foreach ($supporting_members as $supporting_member)
            @if (count($supporting_members) < 6)
                                                        <tr>
                                                            <td class="fw-600"><p class="m-0 text-truncate"><a href="{{ route('party.member.datas', ['id' => $supporting_member->id]) }}">{{ $supporting_member->firstname }}</a></p></td>
                                                            <td>{{ $supporting_member->phone }}</td>
                                                            <td><span class="badge bgc-{{ $supporting_member->status->color }}-50 c-{{ $supporting_member->status->color }}-700 p-10 lh-0 tt-c rounded-pill">{{ $supporting_member->status->status_name }}</span></td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $supporting_member->status->status_name == 'Activé' ? 'checked' : '' }} />
                                                                    <label class="ms-2 form-check-label" for="flexSwitchCheckDefault">{{ $supporting_member->status->status_name != 'Activé' ? __('miscellaneous.activate') : __('miscellaneous.lock') }}</label>
                                                                </div>
                                                            </td>
                                                        </tr>
            @endif
        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-20">
                                        <a href="{{ route('party.member.home') }}">@lang('miscellaneous.manager.home.new_members.link')</a>
                                    </div>
                                </div>
                            </div>

                            <!-- #Other managers ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.other_managers.title')</h6>

                                            <a href="{{ route('party.manager.new') }}" class="position-relative" style="top: -8px" title="@lang('miscellaneous.manager.home.other_managers.add_new')" data-bs-toggle="tooltip">
                                                <span class="bi bi-plus-circle-fill fs-3 me-1 align-middle"></span>@lang('miscellaneous.add')
                                            </a>
                                        </div>
                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @if (count($managers) > 1)
            @foreach ($managers as $manager)
                @if ($manager->id != $current_user->id)
                                                <a href="{{ route('party.manager.datas', ['id' => $manager->id]) }}" class="list-group-item list-group-item-action">
                                                    <div class="row">
                                                        <div class="col-md-2 col-3">
                                                            <div class="bg-image">
                                                                <img src="{{ $manager->avatar_url != null ? $manager->avatar_url : asset('assets/img/user.png') }}" alt="{{ $manager->firstname . ' '. $manager->lastname }}" class="img-fluid rounded-circle">
                                                                <div class="mask"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-9 pt-lg-1 pt-md-3 pt-0">
                                                            <h5 class="h5 m-0 fw-bold text-truncate">{{ $manager->firstname . ' '. $manager->lastname }}</h5>
                                                            <p class="m-0 text-muted">{{ $manager->phone }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                @endif            
            @endforeach
        @else
                                               <span class="list-group-item">@lang('miscellaneous.empty_list')</span>
        @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Recent news ==================== -->
                            <div class="masonry-item col-lg-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_news.title')</h6>

                                            <a href="{{ route('party.infos.entity.new', ['entity' => 'news']) }}" class="position-relative" style="top: -8px" title="@lang('miscellaneous.manager.home.recent_news.add_new')" data-bs-toggle="tooltip">
                                                <span class="bi bi-plus-circle-fill fs-3 me-1 align-middle"></span>@lang('miscellaneous.add')
                                            </a>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($news as $news_item)
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
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_communiques.title')</h6>

                                            <a href="{{ route('party.infos.entity.new', ['entity' => 'communique']) }}" class="position-relative" style="top: -8px" title="@lang('miscellaneous.manager.home.recent_communiques.add_new')" data-bs-toggle="tooltip">
                                                <span class="bi bi-plus-circle-fill fs-3 me-1 align-middle"></span>@lang('miscellaneous.add')
                                            </a>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($communiques as $communique)
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
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.recent_events.title')</h6>

                                            <a href="{{ route('party.infos.entity.new', ['entity' => 'event']) }}" class="position-relative" style="top: -8px" title="@lang('miscellaneous.manager.home.recent_events.add_new')" data-bs-toggle="tooltip">
                                                <span class="bi bi-plus-circle-fill fs-3 me-1 align-middle"></span>@lang('miscellaneous.add')
                                            </a>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <div class="list-group">
        @forelse ($events as $event)
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
                        </div>
    @endif

@endsection
