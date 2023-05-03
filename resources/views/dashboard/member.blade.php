@extends('layouts.app')

@section('app-content')

@if (Route::is('party.member.datas') || Route::is('party.member.update') || Route::is('party.member.new.check_token') ||
Route::is('party.manager.datas'))
<div class="row gap-20">
    <div class="col-lg-4 col-md-6">
        <div class="mb-3 bd bgc-blue-500">
            <div class="layers">
                <div class="layer w-100 px-md-3 px-1 p-20 ta-c">
                    @if (Route::is('party.manager.datas'))
                    <a href="{{ route('manager') }}" class="text-white">
                        <span class="bi bi-arrow-left me-2"></span> @lang('miscellaneous.back_home')
                    </a>
                    @else
                    <a href="{{ route('party.member.home') }}" class="text-white">
                        <span class="bi bi-arrow-left me-2"></span> @lang('miscellaneous.back_list')
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- #Avatar ==================== -->
        <div class="mb-3 bd bgc-white">
            <div class="layers">
                <div class="layer w-100 px-md-3 px-1 p-20">
                    <div class="row">
                        <div class="col-8 mx-auto">
                            <div class="bg-image">
                                <img src="{{ $selected_member->avatar_url != null ? $selected_member->avatar_url : asset('assets/img/user.png') }}"
                                    alt="{{ $selected_member->firstname . ' ' . $selected_member->lastname }}"
                                    class="user-image img-fluid img-thumbnail rounded-circle">
                                <div class="mask"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ta-c bdT w-100 p-10">
                <form method="post">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $selected_member->id }}">
                    <label for="avatar" class="btn btn-white py-0 text-primary shadow-0"
                        style="text-transform: inherit!important;">
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

                    <a href="#" id="rectoVersoText" class="fw-bold text-uppercase"
                        title="@lang('miscellaneous.manager.home.recent_events.add_new')">
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
                                    <h5 class="m-0 fw-bold text-truncate"
                                        style="font-family: Arial Narrow; font-size: 11px;">@lang('miscellaneous.drc')
                                    </h5>
                                    <h3 class="m-0 text-black fw-bold text-truncate"
                                        style="font-family: Arial Narrow; font-size: 11px;">Action Commune pour la
                                        République</h3>
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
                                                <img src="{{ $selected_member->avatar_url != null ? $selected_member->avatar_url : asset('assets/img/user.png') }}"
                                                    alt="{{ $selected_member->firstname . ' ' . $selected_member->lastname }}"
                                                    class="user-image img-fluid rounded-circle">
                                                <div class="mask"></div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2 pb-2 px-1">
                                            <h3 class="m-0 text-center text-black text-uppercase"
                                                style="font-family: 'Segoe UI Semibold'; font-size: 8px;">{{
                                                $selected_member->role_user->role->role_name }}</h3>
                                        </div>
                                    </div>
                                    <p class="m-0 fw-bold text-uppercase" style="font-family: Arial; font-size: 11px;">
                                        <span
                                            class="badge d-block py-2 bgc-{{ $selected_member->status->status_name == 'Activé' && $selected_member->birth_date != null && $residence != null ? 'green' : 'red' }}-600 rounded-0">
                                            <span
                                                class="bi bi-{{ $selected_member->status->status_name == 'Activé' && $selected_member->birth_date != null && $residence != null ? 'check2' : 'x' }}-circle me-1 fs-6"
                                                style="vertical-align: -2px"></span>
                                            {{ $selected_member->status->status_name == 'Activé' &&
                                            $selected_member->birth_date != null && $residence != null ?
                                            __('miscellaneous.validated') : __('miscellaneous.invalid') }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-1 acr-line-height-1_5"
                                        style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.firstname')@lang('miscellaneous.colon_after_word')
                                        <span class="d-inline-block text-black fw-bold text-uppercase">{{
                                            $selected_member->firstname }}</span>
                                        <span
                                            class="float-end">@lang('miscellaneous.gender_title')@lang('miscellaneous.colon_after_word')
                                            <span class="fw-bold text-black">{{ $selected_member->gender
                                                }}</span></span>
                                    </p>
                                    <p class="mb-1 acr-line-height-1_5"
                                        style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.lastname')@lang('miscellaneous.colon_after_word')
                                        <span class="text-black fw-bold text-uppercase">{{ $selected_member->lastname
                                            }}</span>
                                    </p>
                                    <p class="mb-1 acr-line-height-1_5"
                                        style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.surname')@lang('miscellaneous.colon_after_word')
                                        <span class="text-black fw-bold text-uppercase">{{ $selected_member->surname
                                            }}</span>
                                    </p>
                                    <p class="mb-1 acr-line-height-1_5"
                                        style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.birth_city_date')@lang('miscellaneous.colon_after_word')<br>
                                        <span class="text-black fw-bold">{{ $selected_member->birth_city . ', ' .
                                            (!empty($selected_member->birth_date) ? (str_starts_with(app()->getLocale(),
                                            'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d',
                                            $selected_member->birth_date)->format('d/m/Y') :
                                            \Carbon\Carbon::createFromFormat('Y-m-d',
                                            $selected_member->birth_date)->format('m/d/Y')) : null) }}</span>
                                    </p>
                                    <p class="mb-2 acr-line-height-1_5"
                                        style="font-size: 0.68rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.address.title')@lang('miscellaneous.colon_after_word')
                                        <span class="text-black fw-bold">{{ $residence != null ?
                                            $residence->address_content : '- - - - -' }}</span><br>
                                    </p>
                                    <p class="mb-1 acr-line-height-1_5 text-center"
                                        style="font-size: 0.55rem; font-family: Arial; color: #555;">
                                        @lang('miscellaneous.issued_on') {{ str_starts_with(app()->getLocale(), 'fr') ?
                                        \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y') :
                                        \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('m/d/Y') }}
                                    </p>
                                    <div class="mb-1 bg-image text-center">
                                        <img src="{{ asset('assets/img/signature.png') }}" alt="" width="50">
                                        <div class="mask"></div>
                                    </div>
                                    <p class="m-0 acr-line-height-1_5 text-center"
                                        style="font-size: 0.55rem; font-family: Arial; color: #555;">Jean Pierre
                                        TSHIENDA</p>
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
                                    <h5 class="m-0 fw-bold text-truncate"
                                        style="font-family: Arial Narrow; font-size: 11px;">@lang('miscellaneous.drc')
                                    </h5>
                                    <h3 class="m-0 text-black fw-bold text-truncate"
                                        style="font-family: Arial Narrow; font-size: 11px;">Action Commune pour la
                                        République</h3>
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
                                <h6 class="m-0 text-center text-black fw-bold acr-line-height-1_4">{{
                                    $selected_member->serial_number }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($selected_member->status->status_name == 'Activé' && $selected_member->birth_date != null && $residence
            != null)
            <div class="ta-c bdT w-100 p-10">
                <a href="{{ route('party.member.print_card', ['id' => $selected_member->id]) }}" target="_blank">
                    <span class="bi bi-printer-fill me-2"></span>
                    @lang('miscellaneous.account.membership_card.print_card')
                </a>
            </div>
            @endif
        </div>

        <!-- #Identity document ==================== -->
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

    <!-- #Personal Infos ==================== -->
    <div class="col-lg-8 col-md-6">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer d-flex w-100 pX-20 pT-20 pB-10 justify-content-between">
                    <h6 class="lh-1 m-0">@lang('miscellaneous.account.personal_infos.title')</h6>
                </div>

                <div class="layer w-100 pX-20 pT-10 pB-20">
                    <form method="POST" action="{{ route('party.member.update', ['id' => $selected_member->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-lg-4">
                                <label for="register_firstname"
                                    class="form-label mb-1">@lang('miscellaneous.firstname')</label>
                                <input type="text" name="register_firstname" id="register_firstname"
                                    class="form-control" placeholder="@lang('miscellaneous.firstname')"
                                    value="{{ $selected_member->firstname }}">
                                @if (!empty($response_error) AND $response_error->message == $inputs['firstname'])
                                <small id="firstnameHelp" class="text-danger">{{ $response_error->data }}</small>
                                @endif
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_lastname"
                                    class="form-label mb-1">@lang('miscellaneous.lastname')</label>
                                <input type="text" name="register_lastname" id="register_lastname" class="form-control"
                                    placeholder="@lang('miscellaneous.lastname')"
                                    value="{{ $selected_member->lastname }}">
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_surname"
                                    class="form-label mb-1">@lang('miscellaneous.surname')</label>
                                <input type="text" name="register_surname" id="register_surname" class="form-control"
                                    placeholder="@lang('miscellaneous.surname')"
                                    value="{{ $selected_member->surname }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-4">
                                <div class="mb-1" for="select_gender">@lang('miscellaneous.gender_title')</div>
                                <div class="form-check form-check-inline">
                                    <label class="form-label form-check-label align-middle">
                                        <input type="radio" name="register_gender" id="gender1" class="form-check-input"
                                            value="M" {{ $selected_member->gender == 'M' ? 'checked' : '' }}>
                                        @lang('miscellaneous.gender1')
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-label form-check-label align-middle">
                                        <input type="radio" name="register_gender" id="gender2" class="form-check-input"
                                            value="F" {{ $selected_member->gender == 'F' ? 'checked' : '' }}>
                                        @lang('miscellaneous.gender2')
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_nationality"
                                    class="form-label mb-1">@lang('miscellaneous.nationality')</label>
                                <input type="text" name="register_nationality" id="register_nationality"
                                    class="form-control" placeholder="@lang('miscellaneous.nationality')"
                                    value="{{ $selected_member->nationality }}">
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_birth_city"
                                    class="form-label mb-1">@lang('miscellaneous.birth_city')</label>
                                <input type="text" name="register_birth_city" id="register_birth_city"
                                    class="form-control" placeholder="@lang('miscellaneous.birth_city')"
                                    value="{{ $selected_member->birth_city }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-4">
                                <label for="register_birthdate"
                                    class="form-label mb-1">@lang('miscellaneous.birth_date.label')</label>
                                <div class="timepicker-input input-icon">
                                    <div class="input-group">
                                        <div class="input-group-text bgc-grey-300 bd bdwR-0">
                                            <i class="ti-calendar"></i>
                                        </div>
                                        <input type="text" name="register_birthdate" id="register_birthdate"
                                            class="form-control" placeholder="@lang('miscellaneous.birth_date.label')"
                                            value="{{ (!empty($selected_member->birth_date) ? (str_starts_with(app()->getLocale(), 'fr') ? \Carbon\Carbon::createFromFormat('Y-m-d', $selected_member->birth_date)->format('d/m/Y') : \Carbon\Carbon::createFromFormat('Y-m-d', $selected_member->birth_date)->format('m/d/Y')) : null) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_email" class="form-label mb-1">@lang('miscellaneous.email')</label>
                                <input type="text" name="register_email" id="register_email" class="form-control"
                                    placeholder="@lang('miscellaneous.email')" value="{{ $selected_member->email }}">
                                @if (!empty($response_error) AND $response_error->message == $inputs['email'])
                                <small id="emailHelp" class="text-danger">{{ $response_error->data }}</small>
                                @endif
                            </div>

                            <div class="mb-3 col-lg-4">
                                <label for="register_phone" class="form-label mb-1">@lang('miscellaneous.phone')</label>
                                <input type="text" name="register_phone" id="register_phone" class="form-control"
                                    placeholder="@lang('miscellaneous.phone')" value="{{ $selected_member->phone }}">
                                @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                                <small id="phoneHelp" class="text-danger">{{ $response_error->data }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4 border border-default rounded-0 shadow-0">
                                    <div class="card-body pb-0">
                                        <h6 class="h6 text-black fw-bold text-uppercase">
                                            @lang('miscellaneous.address.legal')</h6>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_country"
                                                    class="form-label mb-1">@lang('miscellaneous.admin.country.title')</label>
                                                <select name="register_legal_address_country"
                                                    id="register_legal_address_country" class="form-control">
                                                    <option class="small" {{ $legal_address !=null ? '' : 'selected '
                                                        }}disabled>@lang('miscellaneous.choose_country')</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $legal_address !=null ?
                                                        ($legal_address->country->id == $country->id ? ' selected' : '')
                                                        : '' }}>{{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_city"
                                                    class="form-label mb-1">@lang('miscellaneous.address.city')</label>
                                                <input type="text" name="register_legal_address_city"
                                                    id="register_legal_address_city" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.city')"
                                                    value="{{ $legal_address != null ? $legal_address->city : '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_area"
                                                    class="form-label mb-1">@lang('miscellaneous.address.area')</label>
                                                <input type="text" name="register_legal_address_area"
                                                    id="register_legal_address_area" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.area')"
                                                    value="{{ $legal_address != null ? $legal_address->area : '' }}">
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_neighborhood"
                                                    class="form-label mb-1">@lang('miscellaneous.address.neighborhood')</label>
                                                <input type="text" name="register_legal_address_neighborhood"
                                                    id="register_legal_address_neighborhood" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.neighborhood')"
                                                    value="{{ $legal_address != null ? $legal_address->neighborhood : '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_address_content_1"
                                                    class="form-label mb-1">@lang('miscellaneous.address.line1')</label>
                                                <textarea name="register_legal_address_address_content_1"
                                                    id="register_legal_address_address_content_1" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content : '' }}</textarea>
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_legal_address_address_content_2"
                                                    class="form-label mb-1">@lang('miscellaneous.address.line2')</label>
                                                <textarea name="register_legal_address_address_content_2"
                                                    id="register_legal_address_address_content_2" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.placeholder')">{{ $legal_address != null ? $legal_address->address_content_2 : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card mb-4 border border-default rounded-0 shadow-0">
                                    <div class="card-body pb-0">
                                        <h6 class="h6 text-black fw-bold text-uppercase">
                                            @lang('miscellaneous.address.residence')</h6>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_country"
                                                    class="form-label mb-1">@lang('miscellaneous.admin.country.title')</label>
                                                <select name="register_residence_country"
                                                    id="register_residence_country" class="form-control">
                                                    <option class="small" {{ $residence !=null ? '' : 'selected '
                                                        }}disabled>@lang('miscellaneous.choose_country')</option>
                                                    @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $residence !=null ?
                                                        ($residence->country->id == $country->id ? ' selected' : '') :
                                                        '' }}>{{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_city"
                                                    class="form-label mb-1">@lang('miscellaneous.address.city')</label>
                                                <input type="text" name="register_residence_city"
                                                    id="register_residence_city" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.city')"
                                                    value="{{ $residence != null ? $residence->city : '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_area"
                                                    class="form-label mb-1">@lang('miscellaneous.address.area')</label>
                                                <input type="text" name="register_residence_area"
                                                    id="register_residence_area" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.area')"
                                                    value="{{ $residence != null ? $residence->area : '' }}">
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_neighborhood"
                                                    class="form-label mb-1">@lang('miscellaneous.address.neighborhood')</label>
                                                <input type="text" name="register_residence_neighborhood"
                                                    id="register_residence_neighborhood" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.neighborhood')"
                                                    value="{{ $residence != null ? $residence->neighborhood : '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_address_content_1"
                                                    class="form-label mb-1">@lang('miscellaneous.address.line1')</label>
                                                <textarea name="register_residence_address_content_1"
                                                    id="register_residence_address_content_1" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content : '' }}</textarea>
                                            </div>

                                            <div class="mb-3 col-lg-6">
                                                <label for="register_residence_address_content_2"
                                                    class="form-label mb-1">@lang('miscellaneous.address.line2')</label>
                                                <textarea name="register_residence_address_content_2"
                                                    id="register_residence_address_content_2" class="form-control"
                                                    placeholder="@lang('miscellaneous.address.placeholder')">{{ $residence != null ? $residence->address_content_2 : '' }}</textarea>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="register_p_o_box"
                                                    class="form-label mb-1">@lang('miscellaneous.p_o_box')</label>
                                                <input type="text" name="register_p_o_box" id="register_p_o_box"
                                                    class="form-control" placeholder="@lang('miscellaneous.p_o_box')"
                                                    value="{{ $selected_member->p_o_box }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="register_password"
                                    class="form-label mb-1">@lang('miscellaneous.password.label')</label>
                                <input type="password" name="register_password" id="register_password"
                                    class="form-control">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="confirm_password"
                                    class="form-label mb-1">@lang('miscellaneous.confirm_password.label')</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control">
                            </div>
                        </div>

                        <button type="submit"
                            class="btn btn-block btn-primary btn-color rounded-pill shadow-0">@lang('miscellaneous.register_update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- #Send message to member ==================== -->
    <div class="col-lg-7 col-md-6">
        <div class="bd bgc-white mb-4">
            <div class="layers">
                <div class="layer d-flex w-100 p-20 justify-content-between">
                    <h6 class="lh-1 m-0">@lang('miscellaneous.manager.member.write_to.title') {{
                        $selected_member->firstname . ' ' . $selected_member->lastname }}</h6>
                </div>

                <div class="layer w-100 pX-20 pT-10 pB-20">
                    <form method="POST" action="{{ route('members.send_notif_message') }}">
                        @csrf
                        <input type="hidden" name="member_id" value="{{ $selected_member->id }}">

                        <label for="register_notif_message"
                            class="form-label mb-1 visually-hidden">@lang('miscellaneous.manager.member.write_to.label')</label>
                        <textarea id="register_notif_message" class="form-control mb-4" name="register_notif_message"
                            placeholder="@lang('miscellaneous.manager.member.write_to.label')">{{ $residence != null ? $residence->address_content_2 : '' }}</textarea>

                        <button type="submit"
                            class="btn btn-block btn-light rounded-pill shadow-0">@lang('miscellaneous.send')</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer d-flex w-100 p-20 justify-content-between">
                    <h6 class="lh-1 m-0">@lang('miscellaneous.manager.member.write_to.title') {{
                        $selected_member->firstname . ' ' . $selected_member->lastname }}</h6>
                </div>
                <div>
                    <div class="table-responsive p-20">
                        <table class="table" id="dataList">

                            <tbody id="updateMemberStatus">
                                @forelse ($message_membre as $user)
                                <tr>
                                    <td class="fw-600">
                                        <p class="m-0 text-truncate"><a
                                                href="{{ route('party.member.datas', ['id' => $user->id]) }}">{{$user->notification_content }}</a></p>
                                    </td>
                                    <td>
                                        <a href="http://">@lang('miscellaneous.delete')</a>
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

    <!-- #Member contributions ==================== -->
    <div class="col-lg-5 col-md-6">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer d-flex w-100 p-20 justify-content-between">
                    <h6 class="lh-1 m-0">@lang('miscellaneous.manager.member.contributions')</h6>
                </div>

                <div class="layer w-100 pX-20 pB-20">
                    @forelse ($selected_member->payments as $payment)
                    <div class="d-flex justify-content-between align-items-center mt-2 bg-light small">
                        <div class="px-2 py-1 border-start border-3 bdc-{{ $payment->status->color }}-600">
                            <p class="m-0 text-black">{{ $payment->reference }}</p>
                            <h4 class="h4 mt-0 mb-1 fw-bold c-{{ $payment->status->color }}-600 text-truncate"
                                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $payment->amount
                                . ' ' . $payment->currency }}</h4>
                            <p class="m-0 small">{{ $payment->created_at }}</p>
                        </div>

                        <div class="px-3 py-1 text-center">
                            <p class="m-0 text-black text-uppercase text-truncate">{{ $payment->channel }}</p>
                            <span
                                class="badge bgc-{{ $payment->status->color }}-50 c-{{ $payment->status->color }}-700 p-10 lh-0 tt-c rounded-pill fw-light">{{
                                $payment->status->status_name }}</span>
                        </div>
                    </div>

                    @empty
                    <div class="mt-2 bg-light px-3 py-2">
                        <span class="list-group-item">@lang('miscellaneous.empty_list')</span>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (Route::is('party.member.home') || Route::is('party.member.new'))
<div class="row gap-20">
    <div class="masonry-sizer col-lg-12"></div>

    <!-- #Members list ==================== -->
    <div class="masonry-item col-lg-8">
        <div class="layers bd bgc-white p-10">
            <div class="layer w-100 p-20">
                <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.new_members.title')</h6>
            </div>

            <div class="layer w-100">
                <div class="table-responsive p-20">
                    <table class="table" id="dataList">
                        <thead>
                            <tr>
                                <th class="bdwT-0 fw-bold">@lang('miscellaneous.names')</th>
                                <th class="bdwT-0 fw-bold">@lang('miscellaneous.phone')</th>
                                <th class="bdwT-0 fw-bold">@lang('miscellaneous.admin.miscellaneous.role.title')</th>
                                <th class="bdwT-0 fw-bold">@lang('miscellaneous.admin.miscellaneous.status.title')</th>
                                <th class="bdwT-0 fw-bold">#</th>
                            </tr>
                        </thead>

                        <tbody id="updateMemberStatus">
                            @forelse ($users_not_developer as $user)
                            @if ($user->id != $current_user->id)
                            <tr>
                                <td class="fw-600">
                                    <p class="m-0 text-truncate"><a
                                            href="{{ route('party.member.datas', ['id' => $user->id]) }}">{{
                                            $user->firstname }}</a></p>
                                </td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <select name="select_role" id="role_user-{{ $user->id }}"
                                        class="form-control shadow-0"
                                        onchange="changeRole('role_user-{{ $user->id }}')">
                                        <option class="small" selected disabled>@lang('miscellaneous.choose_role')
                                        </option>
                                        @forelse ($roles as $role)
                                        @if ($role->role_name != 'Administrateur' && $role->role_name != 'Développeur')
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role_user->role->id ? '
                                            selected' : '' }}>{{ $role->role_name }}</option>
                                        @endif
                                        @empty
                                        <option>@lang('miscellaneous.empty_list')</option>
                                        @endforelse
                                    </select>
                                </td>
                                <td><span
                                        class="badge bgc-{{ $user->status->color }}-50 c-{{ $user->status->color }}-700 p-10 lh-0 tt-c rounded-pill">{{
                                        $user->status->status_name }}</span></td>
                                <td>
                                    <div id="status_user-{{ $user->id }}" class="form-check form-switch"
                                        aria-current="{{ $user->status->status_name }}"
                                        onchange="changeStatus('status_user-{{ $user->id }}')">
                                        <input type="checkbox" role="switch" id="{{ $user->id }}"
                                            class="form-check-input" {{ $user->status->status_name == 'Activé' ?
                                        'checked' : '' }} />
                                        <label for="{{ $user->id }}" class="ms-2 form-check-label">{{
                                            $user->status->status_name != 'Activé' ? __('miscellaneous.activate') :
                                            __('miscellaneous.cancel') }}</label>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- #Add a member ==================== -->
    <div class="masonry-item col-lg-4">
        <div class="layers bd bgc-white p-10">
            <div class="layer w-100 p-20">
                <h6 class="lh-1 m-0">@lang('miscellaneous.manager.member.add')</h6>
            </div>

            <div class="layer w-100 pX-20 pT-10 pB-20">
                <form method="POST" action="{{ route('party.member.new') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="register_firstname" id="register_firstname"
                                    class="form-control" placeholder="@lang('miscellaneous.firstname')" required
                                    autofocus>
                                <label for="register_firstname">@lang('miscellaneous.firstname')</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="register_lastname" id="register_lastname" class="form-control"
                                    placeholder="@lang('miscellaneous.surname')">
                                <label for="register_lastname">@lang('miscellaneous.lastname')</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating pt-0">
                                <select name="select_country" id="select_country1" class="form-select pt-2 shadow-0">
                                    <option class="small" selected disabled>@lang('miscellaneous.choose_country')
                                    </option>
                                    @forelse ($countries as $country)
                                    <option value="+{{ $country->country_phone_code }}">{{ $country->country_name }}
                                    </option>
                                    @empty
                                    <option>@lang('miscellaneous.empty_list')</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-group">
                                <span id="phone_code_text1" class="input-group-text d-inline-block h-100 bg-light"
                                    style="padding-top: 0.3rem; padding-bottom: 0.65rem; line-height: 1.35;">
                                    <small class="d-inline-block text-secondary mt-0 mb-1 p-0"
                                        style="font-size: 0.75rem; color: #010101;">@lang('miscellaneous.phone_code')</small><br>
                                    <span class="text-value">xxxx</span>
                                </span>

                                <div class="form-floating">
                                    <input type="hidden" id="phone_code1" name="phone_code_new_member" value="">
                                    <input type="tel" name="phone_number_new_member" id="phone_number_new_member"
                                        class="form-control" placeholder="@lang('miscellaneous.phone')"
                                        aria-describedby="phone_error_message" required>
                                    <label for="phone_number_new_member">@lang('miscellaneous.phone')</label>
                                </div>
                            </div>
                        </div>

                        @if (!empty($response_error) AND $response_error->message == $inputs['phone'])
                        <div class="col-12">
                            <p id="phone_error_message" class="mb-4 text-center text-danger small">{{
                                $response_error->data }}</p>
                        </div>
                        @endif

                        <div class="col-12 text-center">
                            <button
                                class="btn btn-primary btn-color btn-sm-inline-block btn-block rounded-pill shadow-0"
                                type="submit">@lang('miscellaneous.public.home.register_member.register')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
