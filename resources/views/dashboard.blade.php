@extends('layouts.app')

@section('app-content')

    @if ($current_user->role_user->role->role_name == 'Administrateur')
    @endif

    @if ($current_user->role_user->role->role_name == 'Développeur')
    @endif

    @if ($current_user->role_user->role->role_name == 'Manager')
                        <div class="row gap-20 masonry pos-r">
                            <div class="masonry-sizer col-md-6"></div>
                            <div class="masonry-item w-100">
                                <div class="row gap-20">
                                    <!-- #Toatl Visits ==================== -->
                                    <div class="col-md-3">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">Total Visits</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">+10%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- #Total Page Views ==================== -->
                                    <div class="col-md-3">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">Total Page Views</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash2"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- #Unique Visitors ==================== -->
                                    <div class="col-md-3">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">Unique Visitor</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash3"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">~12%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- #Bounce Rate ==================== -->
                                    <div class="col-md-3">
                                        <div class="layers bd bgc-white p-20">
                                            <div class="layer w-100 mB-10">
                                                <h6 class="lh-1">Bounce Rate</h6>
                                            </div>
                                            <div class="layer w-100">
                                                <div class="peers ai-sb fxw-nw">
                                                    <div class="peer peer-greed">
                                                        <span id="sparklinedash4"></span>
                                                    </div>
                                                    <div class="peer">
                                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="masonry-item col-lg-6">
                                <!-- #New Members ==================== -->
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
        @foreach ($users as $user)
            @if ($user->role_user->role->role_name == 'Membre Sympathisant' AND $user->status->status_name != 'Activé')
                                                        <tr>
                                                            <td class="fw-600"><p class="m-0 text-truncate"><a href="{{ route('party.member.datas', ['id' => $user->id]) }}">{{ $user->firstname }}</a></p></td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td><span class="badge bgc-{{ $user->status->color }}-50 c-{{ $user->status->color }}-700 p-10 lh-0 tt-c rounded-pill">{{ $user->status->status_name }}</span></td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $user->status->status_name == 'Activé' ? 'checked' : '' }} />
                                                                    <label class="ms-2 form-check-label" for="flexSwitchCheckDefault">{{ $user->status->status_name != 'Activé' ? __('miscellaneous.activate') : __('miscellaneous.lock') }}</label>
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
                        </div>
    @endif

@endsection
