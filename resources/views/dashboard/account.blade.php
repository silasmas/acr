@extends('layouts.app')

@section('app-content')

                        <div class="row gap-20">
                            <div class="col-lg-4 col-md-6">
                                <!-- #Avatar ==================== -->
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
                                        <form method="POST">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                            <label for="avatar" class="btn btn-white py-0 text-primary shadow-0" style="text-transform: inherit!important;">
                                                <span class="bi bi-image me-2"></span> @lang('miscellaneous.change_image')
                                                <input type="file" name="avatar" id="avatar" class="d-none">
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <!-- #Membership card ==================== -->
                                <div class="mb-3 bd bgc-white">
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
                                                            <div class="card mb-2 border-0 rounded-4 shadow-0">
                                                                <div class="card-body pb-0">
                                                                    <div class="bg-image bg-white rounded-circle" style="margin-top: -3px;">
                                                                        <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid rounded-circle">
                                                                        <div class="mask"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-2 pb-2 px-1">
                                                                    <h3 class="m-0 text-center text-black text-uppercase" style="font-family: 'Segoe UI Semibold'; font-size: 8px;">{{ $current_user->role_user->role->role_name }}</h3>
                                                                </div>
                                                            </div>
                                                            <p class="m-0 fw-bold text-uppercase" style="font-family: Arial; font-size: 11px;">
                                                                <span class="badge d-block py-2 bgc-{{ $current_user->status->status_name == 'Activé' && $current_user->birth_date != null && $residence != null ? 'green' : 'red' }}-600 rounded-0">
                                                                    <span class="bi bi-{{ $current_user->status->status_name == 'Activé' && $current_user->birth_date != null && $residence != null ? 'check2' : 'x' }}-circle me-1 fs-6" style="vertical-align: -2px"></span>
                                                                    {{ $current_user->status->status_name == 'Activé' && $current_user->birth_date != null && $residence != null ? __('miscellaneous.validated') : __('miscellaneous.invalid') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="col-8">
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.firstname')@lang('miscellaneous.colon_after_word') 
                                                                <span class="d-inline-block text-black fw-bold text-uppercase">{{ $current_user->firstname }}</span> 
                                                                <span class="float-end">@lang('miscellaneous.gender_title')@lang('miscellaneous.colon_after_word') <span class="fw-bold text-black">{{ $current_user->gender }}</span></span>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.lastname')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold text-uppercase">{{ $current_user->lastname }}</span>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.surname')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold text-uppercase">{{ $current_user->surname }}</span>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5" style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.birth_city_date')@lang('miscellaneous.colon_after_word')<br>
                                                                <span class="text-black fw-bold">{{ $current_user->birth_city . ', ' . (!empty($current_user->birth_date) ? (str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('m/d/Y')) : null) }}</span>
                                                            </p>
                                                            <p class="mb-2 acr-line-height-1_5" style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.address.title')@lang('miscellaneous.colon_after_word') 
                                                                <span class="text-black fw-bold">{{ $residence != null ? $residence->address_content : '- - - - -' }}</span><br>
                                                            </p>
                                                            <p class="mb-1 acr-line-height-1_5 text-center" style="font-size: 0.55rem; font-family: Arial; color: #555;">
                                                                @lang('miscellaneous.issued_on') {{ str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('m/d/Y') }}
                                                            </p>
                                                            <div class="mb-1 bg-image text-center">
                                                                <img src="{{ asset('assets/img/signature.png') }}" alt="" width="50">
                                                                <div class="mask"></div>
                                                            </div>
                                                            <p class="m-0 acr-line-height-1_5 text-center" style="font-size: 0.55rem; font-family: Arial; color: #555;">Jean Pierre TSHIENDA</p>
                                                        </div>
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
        @if ($current_user->status->status_name == 'Activé' && $current_user->birth_date != null && $residence != null)
                                    <div class="ta-c bdT w-100 p-10">
                                        <a href="{{ route('party.member.print_card', ['id' => $current_user->id]) }}" target="_blank">
                                            <span class="bi bi-printer-fill me-2"></span> @lang('miscellaneous.account.membership_card.print_card')
                                        </a>
                                    </div>
        @endif
                                </div>

                                <!-- #Identity document ==================== -->
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 p-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.identity_document.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                            <form method="POST">
                                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                                                <select name="register_image_name" id="register_image_name" class="form-control mb-3">
                                                    <option class="small" {{ $current_user->identity_data != null ? '' : 'selected ' }}disabled>@lang('miscellaneous.account.identity_document.choose_type.title')</option>
                                                    <option>@lang('miscellaneous.account.identity_document.choose_type.identity_card')</option>
                                                    <option>@lang('miscellaneous.account.identity_document.choose_type.voter_card')</option>
                                                    <option>@lang('miscellaneous.account.identity_document.choose_type.passport')</option>
                                                    <option>@lang('miscellaneous.account.identity_document.choose_type.driving_license')</option>
                                                    <option>@lang('miscellaneous.account.identity_document.choose_type.other')</option>
                                                </select>

                                                <p class="m-0 small"><strong class="text-uppercase">@lang('miscellaneous.recto')</strong> (@lang('miscellaneous.account.identity_document.click_to_change'))</p>
                                                <div class="bg-image rounded overflow-hidden overlay mb-2">
                                                    <img src="{{ $current_user->identity_data != null && $current_user->identity_data->url_recto != null ? $current_user->identity_data->url_recto : asset('assets/img/blank-id-doc.png') }}" alt="@lang('miscellaneous.recto')" alt="" class="identity-recto img-fluid">
                                                    <div class="mask h-100">
                                                        <label role="button" for="image_recto" class="d-flex justify-content-center align-items-center h-100 fs-3 text-black text-uppercase">
                                                            <span class="{{ $current_user->identity_data != null && $current_user->identity_data->url_recto != null ? 'opacity-0' : 'opacity-100' }}">@lang('miscellaneous.recto')</span>
                                                            <input type="file" name="image_recto" id="image_recto" class="d-none">
                                                        </label>
                                                        <input type="hidden" name="data_recto">
                                                    </div>
                                                </div>

                                                <p class="m-0 small"><strong class="text-uppercase">@lang('miscellaneous.verso')</strong> (@lang('miscellaneous.account.identity_document.click_to_change'))</p>
                                                <div class="bg-image rounded overflow-hidden overlay mb-3">
                                                    <img src="{{ $current_user->identity_data != null && $current_user->identity_data->url_verso != null ? $current_user->identity_data->url_verso : asset('assets/img/blank-id-doc.png') }}" alt="@lang('miscellaneous.verso')" alt="" class="identity-verso img-fluid">
                                                    <div class="mask h-100">
                                                        <label role="button" for="image_verso" class="d-flex justify-content-center align-items-center h-100 fs-3 text-black text-uppercase">
                                                            <span class="{{ $current_user->identity_data != null && $current_user->identity_data->url_recto != null ? 'opacity-0' : 'opacity-100' }}">@lang('miscellaneous.verso')</span>
                                                            <input type="file" name="image_verso" id="image_verso" class="d-none">
                                                        </label>
                                                        <input type="hidden" name="data_verso">
                                                    </div>
                                                </div>

                                                <button class="btn btn-block btn-light border border-default rounded-pill shadow-0" type="submit">@lang('miscellaneous.register')</button>
                                            </form>
                                        </div>
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
                                            <form method="POST" action="{{ route('account') }}">
    @csrf
                                                <div class="row">
                                                    <!-- First name -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_firstname" class="form-label mb-1">@lang('miscellaneous.firstname')</label>
                                                        <input type="text" name="register_firstname" id="register_firstname" class="form-control" placeholder="@lang('miscellaneous.firstname')" value="{{ $current_user->firstname }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['firstname'])
                                                        <small id="firstnameHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>

                                                    <!-- Last name -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_lastname" class="form-label mb-1">@lang('miscellaneous.lastname')</label>
                                                        <input type="text" name="register_lastname" id="register_lastname" class="form-control" placeholder="@lang('miscellaneous.lastname')" value="{{ $current_user->lastname }}">
                                                    </div>

                                                    <!-- Surname -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_surname" class="form-label mb-1">@lang('miscellaneous.surname')</label>
                                                        <input type="text" name="register_surname" id="register_surname" class="form-control" placeholder="@lang('miscellaneous.surname')" value="{{ $current_user->surname }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Gender -->
                                                    <div class="mb-3 col-lg-4">
                                                        <div class="mb-1" for="select_gender">@lang('miscellaneous.gender_title')</div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-label form-check-label align-middle">
                                                                <input type="radio" name="register_gender" id="gender1" class="form-check-input" value="M" {{ $current_user->gender == 'M' ? 'checked' : '' }}>
                                                                @lang('miscellaneous.gender1')
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-label form-check-label align-middle">
                                                                <input type="radio" name="register_gender" id="gender2" class="form-check-input" value="F" {{ $current_user->gender == 'F' ? 'checked' : '' }}>
                                                                @lang('miscellaneous.gender2')
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Nationality -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_nationality" class="form-label mb-1">@lang('miscellaneous.nationality')</label>
                                                        <input type="text" name="register_nationality" id="register_nationality" class="form-control" placeholder="@lang('miscellaneous.nationality')" value="{{ $current_user->nationality }}">
                                                    </div>

                                                    <!-- Birth city -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_birth_city" class="form-label mb-1">@lang('miscellaneous.birth_city')</label>
                                                        <input type="text" name="register_birth_city" id="register_birth_city" class="form-control" placeholder="@lang('miscellaneous.birth_city')" value="{{ $current_user->birth_city }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Birth date -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_birthdate" class="form-label mb-1">@lang('miscellaneous.birth_date.label')</label>
                                                        <div class="timepicker-input input-icon">
                                                            <div class="input-group">
                                                                <div class="input-group-text bgc-grey-300 bd bdwR-0">
                                                                    <i class="ti-calendar"></i>
                                                                </div>
                                                                <input type="text" name="register_birthdate" id="register_birthdate" class="form-control" placeholder="@lang('miscellaneous.birth_date.label')" value="{{ (!empty($current_user->birth_date) ? (str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', $current_user->birth_date)->format('m/d/Y')) : null) }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- E-mail -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_email" class="form-label mb-1">@lang('miscellaneous.email')</label>
                                                        <input type="text" name="register_email" id="register_email" class="form-control" placeholder="@lang('miscellaneous.email')" value="{{ $current_user->email }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['email'])
                                                        <small id="emailHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>

                                                    <!-- Phone -->
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="register_phone class="form-label mb-1"">@lang('miscellaneous.phone')</label>
                                                        <input type="text" name="register_phone" id="register_phone" class="form-control" placeholder="@lang('miscellaneous.phone')" value="{{ $current_user->phone }}">
    @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                                                        <small id="phoneHelp" class="text-danger">{{ $response_error->data }}</small>
    @endif
                                                    </div>
                                                </div>

                                                <!-- Adresses -->
                                                <div class="row">
                                                    <!-- Legal address -->
                                                    <div class="col-12">
                                                        <div class="card mb-4 border border-default rounded-0 shadow-0">
                                                            <div class="card-body pb-0">
                                                                <h6 class="h6 text-black fw-bold text-uppercase">@lang('miscellaneous.address.legal')</h6>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_country" class="form-label mb-1">@lang('miscellaneous.admin.country.title')</label>
                                                                        <select name="register_legal_address_country" id="register_legal_address_country" class="form-control">
                                                                            <option class="small" {{ $legal_address != null ? '' : 'selected ' }}disabled>@lang('miscellaneous.choose_country')</option>
    @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}"{{ $legal_address != null ? ($legal_address->country->id == $country->id ? ' selected' : '') : '' }}>{{ $country->country_name }}</option>
    @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_city" class="form-label mb-1">@lang('miscellaneous.address.city')</label>
                                                                        <input type="text" name="register_legal_address_city" id="register_legal_address_city" class="form-control" placeholder="@lang('miscellaneous.address.city')" value="{{ $legal_address != null ? $legal_address->city : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_area" class="form-label mb-1">@lang('miscellaneous.address.area')</label>
                                                                        <input type="text" name="register_legal_address_area" id="register_legal_address_area" class="form-control" placeholder="@lang('miscellaneous.address.area')" value="{{ $legal_address != null ? $legal_address->area : '' }}">
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_neighborhood" class="form-label mb-1">@lang('miscellaneous.address.neighborhood')</label>
                                                                        <input type="text" name="register_legal_address_neighborhood" id="register_legal_address_neighborhood" class="form-control" placeholder="@lang('miscellaneous.address.neighborhood')" value="{{ $legal_address != null ? $legal_address->neighborhood : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_address_content_1" class="form-label mb-1">@lang('miscellaneous.address.line1')</label>
                                                                        <textarea name="register_legal_address_address_content_1" id="register_legal_address_address_content_1" class="form-control" placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_legal_address_address_content_2" class="form-label mb-1">@lang('miscellaneous.address.line2')</label>
                                                                        <textarea name="register_legal_address_address_content_2" id="register_legal_address_address_content_2" class="form-control" placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content_2 : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Residence -->
                                                    <div class="col-12">
                                                        <div class="card mb-4 border border-default rounded-0 shadow-0">
                                                            <div class="card-body pb-0">
                                                                <h6 class="h6 text-black fw-bold text-uppercase">@lang('miscellaneous.address.residence')</h6>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_country" class="form-label mb-1">@lang('miscellaneous.admin.country.title')</label>
                                                                        <select name="register_residence_country" id="register_residence_country" class="form-control">
                                                                            <option class="small" {{ $residence != null ? '' : 'selected ' }}disabled>@lang('miscellaneous.choose_country')</option>
    @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}"{{ $residence != null ? ($residence->country->id == $country->id ? ' selected' : '') : '' }}>{{ $country->country_name }}</option>
    @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_city" class="form-label mb-1">@lang('miscellaneous.address.city')</label>
                                                                        <input type="text" name="register_residence_city" id="register_residence_city" class="form-control" placeholder="@lang('miscellaneous.address.city')" value="{{ $residence != null ? $residence->city : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_area" class="form-label mb-1">@lang('miscellaneous.address.area')</label>
                                                                        <input type="text" name="register_residence_area" id="register_residence_area" class="form-control" placeholder="@lang('miscellaneous.address.area')" value="{{ $residence != null ? $residence->area : '' }}">
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_neighborhood" class="form-label mb-1">@lang('miscellaneous.address.neighborhood')</label>
                                                                        <input type="text" name="register_residence_neighborhood" id="register_residence_neighborhood" class="form-control" placeholder="@lang('miscellaneous.address.neighborhood')" value="{{ $residence != null ? $residence->neighborhood : '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_address_content_1" class="form-label mb-1">@lang('miscellaneous.address.line1')</label>
                                                                        <textarea name="register_residence_address_content_1" id="register_residence_address_content_1" class="form-control" placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content : '' }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_residence_address_content_2" class="form-label mb-1">@lang('miscellaneous.address.line2')</label>
                                                                        <textarea name="register_residence_address_content_2" id="register_residence_address_content_2" class="form-control" placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content_2 : '' }}</textarea>
                                                                    </div>
                                                                    <!-- P.O. box -->
                                                                    <div class="mb-3 col-lg-6">
                                                                        <label for="register_p_o_box" class="form-label mb-1">@lang('miscellaneous.p_o_box')</label>
                                                                        <input type="text" name="register_p_o_box" id="register_p_o_box" class="form-control" placeholder="@lang('miscellaneous.p_o_box')" value="{{ $current_user->p_o_box }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="register_password" class="form-label mb-1">@lang('miscellaneous.password.label')</label>
                                                        <input type="password" name="register_password" id="register_password" class="form-control" placeholder="@lang('miscellaneous.password.label')">
                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label for="confirm_password" class="form-label mb-1">@lang('miscellaneous.confirm_password.label')</label>
                                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="@lang('miscellaneous.confirm_password.label')">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-block btn-primary btn-color rounded-pill shadow-0">@lang('miscellaneous.register_update')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #New contribution ==================== -->
                            <div class="col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer w-100 p-20">
                                            <form method="POST" action="{{ route('donate') }}">
        @csrf
                                                <input type="hidden" name="offer_type_id" value="8">

                                                <div id="financialDonation" class="row g-3 mb-4">
                                                    <div class="col-12">
                                                        <h5 class="h5 m-0 text-uppercase fw-bolder">@lang('miscellaneous.public.home.donate.send_money.title')</h5>
                                                        <p class="small m-0 text-muted">@lang('miscellaneous.public.home.donate.send_money.description')</p>
                                                    </div>
                    
                                                    <div id="paymentMethod">
        @foreach ($transaction_types as $type)
            @if ($type->type_name == 'Mobile money')
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mt-2" type="radio" name="transaction_type_id" id="mobile_money" value="{{ $type->id }}" />
                                                            <label for="mobile_money" class="form-check-label">
                                                                <img src="{{ asset('assets/img/payment-mobile-money.png') }}" alt="Mobile money" width="40">
                                                                @lang('miscellaneous.public.home.donate.send_money.mobile_money')
                                                            </label>
                                                        </div>
            @else
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mt-2" type="radio" name="transaction_type_id" id="bank_card" value="{{ $type->id }}" />
                                                            <label for="bank_card" class="form-check-label">
                                                                <img src="{{ asset('assets/img/payment-credit-card.png') }}" alt="Carte bancaire" width="40">
                                                                @lang('miscellaneous.public.home.donate.send_money.bank_card')
                                                            </label>
                                                        </div>
            @endif
        @endforeach
                                                    </div>
                                                </div>
                    
                                                <div id="amountCurrency" class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="form-floating">
                                                                <input type="number" name="register_amount" id="register_amount" class="form-control" placeholder="@lang('miscellaneous.amount')" required{{ \Session::has('error_message') ? ' autofocus' : '' }}>
                                                                <label for="register_amount">@lang('miscellaneous.amount')</label>
                                                            </div>

                                                            <div class="input-group-prepend">
                                                                <select name="select_currency" id="select_currency" class="form-select input-group-text ps-3 pe-4 py-3 shadow-0" style="height: 3.63rem; background-color: #f3f3f3; border-end-start-radius: 0; border-start-start-radius: 0;">
                                                                    <option class="small" selected disabled>@lang('miscellaneous.currency')</option>
                                                                    <option value="USD">@lang('miscellaneous.usd')</option>
                                                                    <option value="CDF">@lang('miscellaneous.cdf')</option>
                                                                </select>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="phoneNumberForMoney" class="row">
                                                    <div class="col-lg-5 mb-3">
                                                        <div class="form-floating pt-0">
                                                            <select name="select_country" id="select_country3" class="form-select pt-2 shadow-0">
                                                                <option class="small" selected disabled>@lang('miscellaneous.choose_country')</option>
        @forelse ($countries as $country)
                                                                <option value="{{ $country->country_phone_code }}">{{ $country->country_name }}</option>
        @empty
                                                                <option>@lang('miscellaneous.empty_list')</option>
        @endforelse
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7">
                                                        <div class="input-group">
                                                            <span id="phone_code_text3" class="input-group-text d-inline-block h-100 bg-light" style="padding-top: 0.3rem; padding-bottom: 0.65rem; line-height: 1.35;">
                                                                <small class="d-inline-block text-secondary mt-0 mb-1 p-0" style="font-size: 0.75rem; color: #010101;">@lang('miscellaneous.phone_code')</small><br>
                                                                <span class="text-value">xxxx</span> 
                                                            </span>

                                                            <div class="form-floating">
                                                                <input type="hidden" id="phone_code3" name="other_phone_code" value="">
                                                                <input type="tel" name="other_phone_number" id="other_phone_number" class="form-control" placeholder="@lang('miscellaneous.phone')">
                                                                <label for="other_phone_number">@lang('miscellaneous.phone')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-block btn-light border border-default mt-lg-0 mt-3 rounded-pill shadow-0">@lang('miscellaneous.send')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #My contributions ==================== -->
                            <div class="col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 p-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.my_contributions.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pB-20">
                                            <ul class="element" data-config='{ "type": "list", "limit": 3, "element": "li", "more": "↓ show more", "less": "↑ less", "number": true }' style="padding-left: 0;">
        @forelse ($current_user->payments as $payment)
                                                <li class="d-flex justify-content-between align-items-center mt-2 bg-light small" style="list-style: none;">
                                                    <div class="px-2 py-1 border-start border-3 bdc-{{ $payment->status->color }}-600">
                                                        <p class="m-0 text-black">{{ $payment->reference }}</p>
                                                        <h4 class="h4 mt-0 mb-1 fw-bold c-{{ $payment->status->color }}-600 text-truncate" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $payment->amount . ' ' . $payment->currency }}</h4>
                                                        <p class="m-0 small">{{ $payment->created_at }}</p>
                                                    </div>

                                                    <div class="px-3 py-1 text-center">
                                                        <p class="m-0 text-black text-uppercase text-truncate">{{ $payment->channel }}</p>
                                                        <span class="badge bgc-{{ $payment->status->color }}-50 c-{{ $payment->status->color }}-700 p-10 lh-0 tt-c rounded-pill fw-light">{{ $payment->status->status_name }}</span>
                                                    </div>
                                                </li>
        @empty
                                                <li class="mt-2 border border-default rounded px-3 py-2" style="list-style: none;">@lang('miscellaneous.empty_list')</li>
        @endforelse
                                            </ul>
                                            {{-- <a href="#" class="btn btn-block btn-secondary btn-color my-3 rounded-0 shadow-0 more-trigger">@lang('miscellaneous.see_more')</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection
