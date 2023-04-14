@extends('layouts.app')

@section('app-content')

                        <div class="row gap-20">
                            <!-- #Membership card ==================== -->
                            <div class="col-lg-4 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pY-10 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.membership_card.title')</h6>

                                            <a id="rectoVersoText" href="#" title="@lang('miscellaneous.manager.home.recent_events.add_new')" class="fw-bold text-uppercase">
                                                <span>@lang('miscellaneous.verso')</span> <i class="bi bi-arrow-repeat"></i>
                                            </a>
                                        </div>

                                        <div class="layer w-100 px-md-3 px-1 pT-10 pB-20">
                                            <!-- Membership card -->
                                            <div class="p-10 acr-bg-navy-blue border border-2 border-info rounded-3" style="min-height: 230px;">
                                                <!-- RECTO -->
                                                <div id="cardRecto">
                                                    <div class="row g-1 mb-2 pb-2 border-bottom border-3 border-warning">
                                                        <div class="col-2">
                                                            <div class="bg-image">
                                                                <img src="{{ asset('assets/img/drc-flag.png') }}" alt="" class="img-fluid">
                                                                <div class="mask"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 pt-1 text-center text-uppercase">
                                                            <h5 class="m-0 fw-bold text-truncate" style="font-family: Arial Narrow; font-size: 11px;">@lang('miscellaneous.drc')</h5>
                                                            <h3 class="m-0 text-black fw-bold text-truncate" style="font-family: Arial Narrow; font-size: 11px;">Action Commune pour la République</h3>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="bg-image bg-white rounded-circle" style="margin-top: -3px;">
                                                                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid">
                                                                <div class="mask"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3">
                                                        <div class="col-4">
                                                            <div class="card border-0 rounded-4 shadow-0">
                                                                <div class="card-body pb-0">
                                                                    <div class="bg-image bg-white rounded-circle" style="margin-top: -3px;">
                                                                        <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="img-fluid rounded-circle">
                                                                        <div class="mask"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-2 pb-2 px-1">
                                                                    <h3 class="m-0 text-center text-black text-uppercase" style="font-family: 'Segoe UI Semibold'; font-size: 9px;">{{ $current_user->role_user->role->role_name }}</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.8rem; font-family: 'Segoe UI'; color: #555;">
                                                                @lang('miscellaneous.firstname')@lang('miscellaneous.colon_after_word') 
                                                                <span class="d-inline-block me-4 text-black fw-bold text-uppercase">{{ $current_user->firstname }}</span> 
                                                                @lang('miscellaneous.gender_title')@lang('miscellaneous.colon_after_word') <span class="fw-bold text-black">{{ $current_user->gender }}</span>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.8rem; font-family: 'Segoe UI'; color: #555;">
                                                                @lang('miscellaneous.lastname_surname')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold text-uppercase">{{ $current_user->lastname . ' ' . $current_user->surname }}</span>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.8rem; font-family: 'Segoe UI'; color: #555;">
                                                                @lang('miscellaneous.birth_city_date')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold">{{ $current_user->birth_city . ', ' . $current_user->birth_date }}</span>
                                                            </p>
                                                            <p class="m-0 acr-line-height-1_5" style="font-size: 0.8rem; font-family: 'Segoe UI'; color: #555;">
                                                                @lang('miscellaneous.address.title')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold">{{ $residence != null ? $residence->address_content : '- - - - -' }}</span><br>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="py-2">
                                                        <h6 class="m-0 py-1 bg-warning text-center text-black fw-bold text-uppercase" style="font-size: 0.8rem;">
                                                            @lang('miscellaneous.account.membership_card.title')
                                                        </h6>
                                                    </div>
                                                </div>

                                                <!-- RECTO -->
                                                <div id="cardVerso" class="d-none">
                                                    <div class="row g-1 pb-2 border-bottom border-3 border-warning">
                                                        <div class="col-2">
                                                            <div class="bg-image">
                                                                <img src="{{ asset('assets/img/drc-flag.png') }}" alt="" class="img-fluid">
                                                                <div class="mask"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 pt-1 text-center text-uppercase">
                                                            <h5 class="m-0 fw-bold text-truncate" style="font-family: Arial Narrow; font-size: 11px;">@lang('miscellaneous.drc')</h5>
                                                            <h3 class="m-0 text-black fw-bold text-truncate" style="font-family: Arial Narrow; font-size: 11px;">Action Commune pour la République</h3>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="bg-image bg-white rounded-circle" style="margin-top: -3px;">
                                                                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid">
                                                                <div class="mask"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mx-auto mt-3" style="width: 148px;">{{ $qr_code }}</div>

                                                    <div class="mx-auto mt-2">
                                                        <h6 class="m-0 text-center text-black fw-bold acr-line-height-1_4">{{ $current_user->serial_number }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-10">
                                        <a href="{{ route('party.member.print_card', ['id' => $current_user->id]) }}" target="_blank">
                                            <span class="bi bi-printer-fill"></span> @lang('miscellaneous.account.membership_card.print_card')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- #Personal Infos ==================== -->
                            <div class="col-lg-8 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 p-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.personal_infos.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <form action="{{ route('account') }}" method="POST">
                                                <div class="row">
                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_firstname">@lang('miscellaneous.firstname')</label>
                                                        <input type="text" class="form-control" id="register_firstname" placeholder="@lang('miscellaneous.firstname')" value="{{ $current_user->firstname }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_lastname">@lang('miscellaneous.lastname')</label>
                                                        <input type="text" class="form-control" id="register_lastname" placeholder="@lang('miscellaneous.lastname')" value="{{ $current_user->lastname }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_surname">@lang('miscellaneous.surname')</label>
                                                        <input type="text" class="form-control" id="register_surname" placeholder="@lang('miscellaneous.surname')" value="{{ $current_user->surname }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_phone">@lang('miscellaneous.phone')</label>
                                                        <input type="text" class="form-control" id="register_phone" placeholder="@lang('miscellaneous.phone')" value="{{ $current_user->phone }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_email">@lang('miscellaneous.email')</label>
                                                        <input type="text" class="form-control" id="register_email" placeholder="@lang('miscellaneous.email')" value="{{ $current_user->email }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4 col-md-6">
                                                        <label class="form-label mb-0" for="register_birthdate">@lang('miscellaneous.birth_date.label')</label>
                                                        <input type="text" class="form-control" id="register_birthdate" placeholder="@lang('miscellaneous.birth_date.label')" value="{{ $current_user->birth_date }}">
                                                    </div>
                                                </div>                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Change password ==================== -->
                            <div class="col-lg-8 col-md-7">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.update_password.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Identity document ==================== -->
                            <div class="col-lg-4 col-md-5">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.identity_document.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #New contribution ==================== -->
                            <div class="col-lg-7 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.my_contributions.send_money.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #My contributions ==================== -->
                            <div class="col-lg-5 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.my_contributions.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection
