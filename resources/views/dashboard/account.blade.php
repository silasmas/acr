@extends('layouts.app')

@section('app-content')

                        <div class="row gap-20">
                            <!-- #Avatar & Membership card ==================== -->
                            <div class="col-lg-4 col-md-6">
                                <!-- Membership card -->
                                <div class="mb-3 bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 px-md-3 px-1 p-20">
                                            <div class="row">
                                                <div class="col-8 mx-auto">
                                                    <div class="bg-image">
                                                        <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid img-thumbnail rounded-circle">
                                                        <div class="mask"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ta-c bdT w-100 p-10">
                                        <form method="post">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                            <label for="avatar" class="btn btn-white py-0 text-primary shadow-0" style="text-transform: inherit!important;">
                                                <span class="bi bi-image me-2"></span> @lang('miscellaneous.change_image')
                                                <input type="file" name="avatar" id="avatar" class="d-none">
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pY-10 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.membership_card.title')</h6>

                                            <a href="#" id="rectoVersoText" class="fw-bold text-uppercase" title="@lang('miscellaneous.manager.home.recent_events.add_new')">
                                                <span>@lang('miscellaneous.verso')</span> <i class="bi bi-arrow-repeat"></i>
                                            </a>
                                        </div>

                                        <div class="layer w-100 px-md-3 px-1 pT-10 pB-20">
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
                                                                        <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid rounded-circle">
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
                                                                <span class="text-black fw-bold">{{ $current_user->birth_city . ', ' . (str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('m/d/Y')) }}</span>
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

                                                <!-- VERSO -->
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

                                                    <div class="mx-auto mt-3" style="width: 148px;">
                                                        <img src="data:image/png;base64,{{ base64_encode($qr_code) }}" alt="QR Code">
                                                    </div>

                                                    <div class="mx-auto mt-2">
                                                        <h6 class="m-0 text-center text-black fw-bold acr-line-height-1_4">{{ $current_user->serial_number }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ta-c bdT w-100 p-10">
                                        <a href="{{ route('party.member.print_card', ['id' => $current_user->id]) }}" target="_blank">
                                            <span class="bi bi-printer-fill me-2"></span> @lang('miscellaneous.account.membership_card.print_card')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- #Personal Infos ==================== -->
                            <div class="col-lg-8 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 pB-10 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.personal_infos.title')</h6>

                                            <span class="dropdown position-relative" style="top: -3px;">
                                                <a href="#" data-bs-toggle="dropdown">
                                                    <i class="bi bi-translate align-middle"></i> @lang('miscellaneous.your_language')
                                                </a>
                                                <div class="dropdown-menu bg-light mT-10 overflow-hidden">
    @foreach ($available_locales as $locale_name => $available_locale)
        @if ($available_locale != $current_locale)
                                                    <a class="dropdown-item" href="{{ route('change_language', ['locale' => $available_locale]) }}">
            @switch($available_locale)
                @case('ln')
                                                        <span class="fi fi-cd me-3"></span>
                    @break
                @case('en')
                                                        <span class="fi fi-us me-3"></span>
                    @break
                @default
                                                        <span class="fi fi-{{ $available_locale }} me-3"></span>
            @endswitch
                                                        {{ $locale_name }}
                                                    </a>
        @endif
    @endforeach
                                                </div>
                                            </span>    

                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <form action="{{ route('account') }}" method="POST">
                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_firstname">@lang('miscellaneous.firstname')</label>
                                                        <input type="text" class="form-control" id="register_firstname" placeholder="@lang('miscellaneous.firstname')" value="{{ $current_user->firstname }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['firstname'])
                                                        <small id="firstnameHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_lastname">@lang('miscellaneous.lastname')</label>
                                                        <input type="text" class="form-control" id="register_lastname" placeholder="@lang('miscellaneous.lastname')" value="{{ $current_user->lastname }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_surname">@lang('miscellaneous.surname')</label>
                                                        <input type="text" class="form-control" id="register_surname" placeholder="@lang('miscellaneous.surname')" value="{{ $current_user->surname }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <div class="mb-1" for="select_gender">@lang('miscellaneous.gender_title')</div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-label form-check-label align-middle">
                                                                <input class="form-check-input" type="radio" name="register_gender" id="gender1" value="M" {{ $current_user->gender == 'M' ? 'checked' : '' }}>
                                                                @lang('miscellaneous.gender1')
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-label form-check-label align-middle">
                                                                <input class="form-check-input" type="radio" name="register_gender" id="gender2" value="F" {{ $current_user->gender == 'F' ? 'checked' : '' }}>
                                                                @lang('miscellaneous.gender2')
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_nationality">@lang('miscellaneous.nationality')</label>
                                                        <input type="text" class="form-control" id="register_nationality" placeholder="@lang('miscellaneous.nationality')" value="{{ $current_user->nationality }}">
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_birth_city">@lang('miscellaneous.birth_city')</label>
                                                        <input type="text" class="form-control" id="register_birth_city" placeholder="@lang('miscellaneous.birth_city')" value="{{ $current_user->birth_city }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_birthdate">@lang('miscellaneous.birth_date.label')</label>
                                                        <div class="timepicker-input input-icon">
                                                            <div class="input-group">
                                                                <div class="input-group-text bgc-grey-300 bd bdwR-0">
                                                                    <i class="ti-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control" id="register_birthdate" placeholder="@lang('miscellaneous.birth_date.label')" value="{{ str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('m/d/Y') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_email">@lang('miscellaneous.email')</label>
                                                        <input type="text" class="form-control" id="register_email" placeholder="@lang('miscellaneous.email')" value="{{ $current_user->email }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['email'])
                                                        <small id="emailHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>

                                                    <div class="mb-3 col-lg-4">
                                                        <label class="form-label mb-1" for="register_phone">@lang('miscellaneous.phone')</label>
                                                        <input type="text" class="form-control" id="register_phone" placeholder="@lang('miscellaneous.phone')" value="{{ $current_user->phone }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                                                        <small id="phoneHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>
                                                </div>                            

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mb-4 border border-default rounded-0 shadow-0">
                                                            <div class="card-body pb-0">
                                                                <h6 class="h6 text-black fw-bold text-uppercase">@lang('miscellaneous.address.legal')</h6>
                                                                <input type="hidden" name="legal_address_type_id" value="{{ $legal_address != null ? $legal_address->type->id : '' }}">
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_country">@lang('miscellaneous.admin.country.title')</label>
                                                                        <select id="register_legal_address_country" name="register_legal_address_country" class="form-control">
                                                                            <option class="small" {{ $legal_address != null ? '' : 'selected ' }}disabled>@lang('miscellaneous.choose_country')</option>
    @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}"{{ $legal_address != null ? ($legal_address->country->id == $country->id ? ' selected' : '') : '' }}>{{ $country->country_name }}</option>
    @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_city">@lang('miscellaneous.address.city')</label>
                                                                        <input type="text" class="form-control" id="register_legal_address_city" name="register_legal_address_city" placeholder="@lang('miscellaneous.address.city')" value="{{ $legal_address != null ? $legal_address->city : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_area">@lang('miscellaneous.address.area')</label>
                                                                        <input type="text" class="form-control" id="register_legal_address_area" name="register_legal_address_area" placeholder="@lang('miscellaneous.address.area')" value="{{ $legal_address != null ? $legal_address->area : '' }}">
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_neighborhood">@lang('miscellaneous.address.neighborhood')</label>
                                                                        <input type="text" class="form-control" id="register_legal_address_neighborhood" name="register_legal_address_neighborhood" placeholder="@lang('miscellaneous.address.neighborhood')" value="{{ $legal_address != null ? $legal_address->neighborhood : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_address_content_1">@lang('miscellaneous.address.line1')</label>
                                                                        <textarea id="register_legal_address_address_content_1" class="form-control" name="register_legal_address_address_content_1" placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_legal_address_address_content_2">@lang('miscellaneous.address.line2')</label>
                                                                        <textarea id="register_legal_address_address_content_2" class="form-control" name="register_legal_address_address_content_2" placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content_2 : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card mb-4 border border-default rounded-0 shadow-0">
                                                            <div class="card-body pb-0">
                                                                <h6 class="h6 text-black fw-bold text-uppercase">@lang('miscellaneous.address.residence')</h6>
                                                                <input type="hidden" name="residence_type_id" value="{{ $residence != null ? $residence->type->id : '' }}">
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_country">@lang('miscellaneous.admin.country.title')</label>
                                                                        <select id="register_residence_country" name="register_residence_country" class="form-control">
                                                                            <option class="small" {{ $residence != null ? '' : 'selected ' }}disabled>@lang('miscellaneous.choose_country')</option>
    @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}"{{ $residence != null ? ($residence->country->id == $country->id ? ' selected' : '') : '' }}>{{ $country->country_name }}</option>
    @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_city">@lang('miscellaneous.address.city')</label>
                                                                        <input type="text" class="form-control" id="register_residence_city" name="register_residence_city" placeholder="@lang('miscellaneous.address.city')" value="{{ $residence != null ? $residence->city : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_area">@lang('miscellaneous.address.area')</label>
                                                                        <input type="text" class="form-control" id="register_residence_area" name="register_residence_area" placeholder="@lang('miscellaneous.address.area')" value="{{ $residence != null ? $residence->area : '' }}">
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_neighborhood">@lang('miscellaneous.address.neighborhood')</label>
                                                                        <input type="text" class="form-control" id="register_residence_neighborhood" name="register_residence_neighborhood" placeholder="@lang('miscellaneous.address.neighborhood')" value="{{ $residence != null ? $residence->neighborhood : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_address_content_1">@lang('miscellaneous.address.line1')</label>
                                                                        <textarea id="register_residence_address_content_1" class="form-control" name="register_residence_address_content_1" placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label class="form-label mb-1" for="register_residence_address_content_2">@lang('miscellaneous.address.line2')</label>
                                                                        <textarea id="register_residence_address_content_2" class="form-control" name="register_residence_address_content_2" placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content_2 : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-block btn-primary btn-color rounded-pill shadow-0">@lang('miscellaneous.register_update')</button>
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
