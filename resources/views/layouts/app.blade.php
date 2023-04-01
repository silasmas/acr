<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="@lang('miscellaneous.keywords')">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="acr-devref" content="{{ getToken() }}">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/img/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- Font Icons Files -->
        <link rel="stylesheet" href="{{ asset('assets/icons/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/boxicons/css/boxicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/remixicon/remixicon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css">

        <!-- Addons CSS Files -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/mdb/css/mdb.min.css') }}">
        <!-- Adminator CSS File -->
        <style>
            #loader {transition: all 0.3s ease-in-out; opacity: 1; visibility: visible; position: fixed; height: 100vh; width: 100%; background: #fff; z-index: 90000;}
            #loader.fadeOut {opacity: 0; visibility: hidden;}
            .spinner {width: 40px; height: 40px; position: absolute; top: calc(50% - 20px); left: calc(50% - 20px); background-color: #333; border-radius: 100%; -webkit-animation: sk-scaleout 1.0s infinite ease-in-out; animation: sk-scaleout 1.0s infinite ease-in-out;}

            @-webkit-keyframes sk-scaleout {0% {-webkit-transform: scale(0)} 100% { -webkit-transform: scale(1.0); opacity: 0;}}
            @keyframes sk-scaleout {0% {-webkit-transform: scale(0); transform: scale(0);} 100% {-webkit-transform: scale(1.0); transform: scale(1.0); opacity: 0;}}
        </style>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.adminator.css') }}">

        <!-- Custom CSS File -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.custom.css') }}">

        <!-- JavaScript Libraries -->
        <script src="{{ asset('assets/addons/custom/jquery/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/jquery/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/mdb/js/mdb.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/cropper/js/cropper.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/autosize/js/autosize.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/biliap/js/biliap.cores.js') }}"></script>

        <!-- Adminator Javascript -->
        <script defer="defer" src="{{ asset('assets/js/scripts.adminator.js') }}"></script>
        <!-- Custom Javascript -->
        <script src="{{ asset('assets/js/scripts.custom.js') }}"></script>

        <title>
{{-- Titles of all roles --}}
@if (Route::is('account') || Route::is('account.update.password'))
            @lang('menu.account_settings')
@endif

@if (Route::is('message.inbox'))
            @lang('miscellaneous.message.inbox')
@endif

@if (Route::is('message.outbox'))
            @lang('miscellaneous.message.outbox')
@endif

@if (Route::is('message.draft'))
            @lang('miscellaneous.message.draft')
@endif

@if (Route::is('message.spams'))
            @lang('miscellaneous.message.spams')
@endif

@if (Route::is('message.new'))
            @lang('miscellaneous.message.new')
@endif

@if (Route::is('message.search'))
            @lang('miscellaneous.message.search_result')
@endif

{{-- Admin titles --}}
@if ($current_user->role_users[0]->role->role_name == 'Administrateur')
    @if (Route::is('admin') || request()->user_role == 'admin')
            @lang('miscellaneous.admin.home.title')
    @endif

    @if (Route::is('legal_info.home') || Route::is('legal_info.datas'))
            @lang('miscellaneous.admin.legal_info_subject.title')
    @endif

    @if (Route::is('legal_info.entity.home') || Route::is('legal_info.entity.datas'))
            @if (!empty($entity))
                @if ($entity == 'title')
                    @lang('miscellaneous.admin.legal_info_subject.legal_info_title.title')
                @endif

                @if ($entity == 'content')
                    @lang('miscellaneous.admin.legal_info_subject.legal_info_content.title')
                @endif

            @else
                @lang('miscellaneous.admin.legal_info_subject.title')
            @endif
    @endif

    @if (Route::is('country.home') || Route::is('country.datas'))
            @lang('miscellaneous.admin.legal_info_subject.title')
    @endif

    @if (Route::is('miscellaneous.home') || Route::is('miscellaneous.datas'))
            @lang('miscellaneous.admin.miscellaneous.title')
    @endif

    @if (Route::is('miscellaneous.entity.home') || Route::is('miscellaneous.entity.datas'))
            @if (!empty($entity))
                @if ($entity == 'group')
                    @lang('miscellaneous.admin.miscellaneous.group.title')
                @endif

                @if ($entity == 'type')
                    @lang('miscellaneous.admin.miscellaneous.type.title')
                @endif

                @if ($entity == 'role')
                    @lang('miscellaneous.admin.miscellaneous.role.title')
                @endif

                @if ($entity == 'admins')
                    @lang('miscellaneous.admin.miscellaneous.other_admin.title')
                @endif

                @if ($entity == 'developers')
                    @lang('miscellaneous.admin.miscellaneous.other_admin.title')
                @endif

                @if ($entity == 'managers')
                    @lang('miscellaneous.admin.miscellaneous.other_admin.title')
                @endif
            @else
                @lang('miscellaneous.admin.miscellaneous.title')
            @endif
    @endif

    @if (Route::is('legal_info.search') || Route::is('legal_info.entity.search') || Route::is('country.search') || Route::is('miscellaneous.search') || Route::is('miscellaneous.entity.search'))
            @lang('miscellaneous.message.search_result')
    @endif
@endif

{{-- Developer titles --}}
@if ($current_user->role_users[0]->role->role_name == 'Développeur')
    @if (Route::is('developer') || request()->user_role == 'developer')
            @lang('miscellaneous.developer.home.title')
    @endif

    @if (Route::is('apis.home') || Route::is('apis.entity'))
            @lang('miscellaneous.menu.developer.apis')
    @endif
@endif

{{-- Manager titles --}}
@if ($current_user->role_users[0]->role->role_name == 'Manager')
    @if (Route::is('manager') || request()->user_role == 'manager')
            @lang('miscellaneous.manager.home.title')
    @endif

    @if (Route::is('party.member.home') || Route::is('party.member.datas') || Route::is('party.member.new') || Route::is('party.member.on_going'))
            @lang('miscellaneous.menu.manager.members')
    @endif

    @if (Route::is('party.managers') || Route::is('party.manager.new') || Route::is('party.manager.datas'))
            @lang('miscellaneous.menu.manager.members')
    @endif

    @if (Route::is('party.infos'))
            @lang('miscellaneous.manager.info.title')
    @endif

    @if (Route::is('party.infos.entity'))
            @if (!empty($entity))
                @if ($entity == 'news')
                    @lang('miscellaneous.manager.info.news.title')
                @endif

                @if ($entity == 'communique')
                    @lang('miscellaneous.manager.info.communique.title')
                @endif

                @if ($entity == 'event')
                    @lang('miscellaneous.manager.info.event.title')
                @endif

            @else
                @lang('miscellaneous.manager.info.title')
            @endif
    @endif
@endif
        </title>
    </head>

    <body class="app">
        <div id="loader">
            <div class="spinner"></div>
        </div>

        <script>
            window.addEventListener('load', function load() {
                const loader = document.getElementById('loader');

                setTimeout(function() {
                    loader.classList.add('fadeOut');
                }, 300);
            });
        </script>

        <div>
            <!-- #Left Sidebar ==================== -->
            <div class="sidebar">
                <div class="sidebar-inner">
                    <!-- ### $Sidebar Header ### -->
                    <div class="sidebar-logo bg-light">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer peer-greed">
@if ($current_user->role_users[0]->role->role_name == 'Administrateur')
                                <a class="sidebar-link td-n" href="{{ route('admin') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo mt-4 ms-3">
                                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="37">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h3 class="h3 mB-0 logo-text fw-bold"><span class="acr-text-red-2">A</span><span class="acr-text-yellow">C</span><span class="acr-text-blue">R</span></h3>
                                        </div>
                                    </div>
                                </a>
@endif

@if ($current_user->role_users[0]->role->role_name == 'Développeur')
                                <a class="sidebar-link td-n" href="{{ route('manager') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo mt-4 ms-3">
                                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="37">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h3 class="h3 mB-0 logo-text fw-bold"><span class="acr-text-red-2">A</span><span class="acr-text-yellow">C</span><span class="acr-text-blue">R</span></h3>
                                        </div>
                                    </div>
                                </a>
@endif

@if ($current_user->role_users[0]->role->role_name == 'Manager')
                                <a class="sidebar-link td-n" href="{{ route('manager') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo mt-4 ms-3">
                                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="37">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h3 class="h3 mB-0 logo-text fw-bold"><span class="acr-text-red-2">A</span><span class="acr-text-yellow">C</span><span class="acr-text-blue">R</span></h3>
                                        </div>
                                    </div>
                                </a>
@endif
                            </div>
                            <div class="peer">
                                <div class="mobile-toggle sidebar-toggle">
                                    <a href="" class="td-n">
                                        <i class="ti-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### $Sidebar Menu ### -->
                    <ul class="sidebar-menu scrollable pos-r pt-2">
@if ($current_user->role_users[0]->role->role_name == 'Administrateur')
                        <li class="nav-item{{ Route::is('admin') OR request()->user_role == 'admin' ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin') }}">
                                <span class="icon-holder">
                                    <i class="ti-home align-middle c-blue-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.dashboard')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('message.inbox') OR Route::is('message.outbox') OR Route::is('message.draft') OR Route::is('message.spams') OR Route::is('message.new') OR Route::is('message.search') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('message.inbox') }}">
                                <span class="icon-holder">
                                    <i class="ti-email align-middle c-brown-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.messages')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('legal_info.home') OR Route::is('legal_info.datas') OR Route::is('legal_info.entity.home') OR Route::is('legal_info.entity.datas') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('legal_info.home') }}">
                                <span class="icon-holder">
                                    <i class="bi bi-shield-check align-middle c-blue-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.admin.legal_info')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('country.home') OR Route::is('country.datas') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('country.home') }}">
                                <span class="icon-holder">
                                    <i class="bi bi-pin-map-fill align-middle c-deep-orange-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.admin.country')</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="ti-view-list-alt align-middle c-teal-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.admin.miscellaneous')</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('miscellaneous.home') OR Route::is('miscellaneous.datas') OR Route::is('miscellaneous.entity.home') OR Route::is('miscellaneous.entity.datas') ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.home') }}">
                                        <span>@lang('miscellaneous.menu.home')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'group' OR Route::is('miscellaneous.entity.datas') AND $entity == 'group' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'group']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.group.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'type' OR Route::is('miscellaneous.entity.datas') AND $entity == 'type' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'type']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.type.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'role' OR Route::is('miscellaneous.entity.datas') AND $entity == 'role' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'role']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.role.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'admins' OR Route::is('miscellaneous.entity.datas') AND $entity == 'admins' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'admins']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.other_admin.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'developers' OR Route::is('miscellaneous.entity.datas') AND $entity == 'developers' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'developers']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.developers.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('miscellaneous.entity.home') AND $entity == 'managers' OR Route::is('miscellaneous.entity.datas') AND $entity == 'managers' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'managers']) }}">
                                        <span>@lang('miscellaneous.admin.miscellaneous.managers.title')</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
@endif

@if ($current_user->role_users[0]->role->role_name == 'Développeur')
                        <li class="nav-item{{ Route::is('developer') OR request()->user_role == 'developer' ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('developer') }}">
                                <span class="icon-holder">
                                    <i class="c-blue-500 ti-home"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.dashboard')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('message.inbox') OR Route::is('message.outbox') OR Route::is('message.draft') OR Route::is('message.spams') OR Route::is('message.new') OR Route::is('message.search') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('message.inbox') }}">
                                <span class="icon-holder">
                                    <i class="c-brown-500 ti-email"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.messages')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('apis.home') OR Route::is('apis.entity') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('apis.home') }}">
                                <span class="icon-holder">
                                    <i class="c-blue-500 ti-share"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.developer.apis')</span>
                            </a>
                        </li>
@endif

@if ($current_user->role_users[0]->role->role_name == 'Manager')
                        <li class="nav-item{{ Route::is('manager') OR request()->user_role == 'manager' ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('manager') }}">
                                <span class="icon-holder">
                                    <i class="c-blue-500 align-middle ti-home"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.dashboard')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('message.inbox') OR Route::is('message.outbox') OR Route::is('message.draft') OR Route::is('message.spams') OR Route::is('message.new') OR Route::is('message.search') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('message.inbox') }}">
                                <span class="icon-holder">
                                    <i class="c-brown-500 align-middle ti-email"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.messages')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('party.member.home') OR Route::is('party.member.datas') OR Route::is('party.member.new') OR Route::is('party.member.on_going') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('party.member.home') }}">
                                <span class="icon-holder">
                                    <i class="bi bi-people align-middle c-orange-700 fs-5"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.manager.members')</span>
                            </a>
                        </li>

                        <li class="nav-item{{ Route::is('party.managers') OR Route::is('party.manager.new') OR Route::is('party.manager.datas') ? ' actived' : '' }}">
                            <a class="sidebar-link" href="{{ route('party.managers') }}">
                                <span class="icon-holder">
                                    <i class="bi bi-clipboard-pulse c-green-700 align-middle"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.manager.other_managers')</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="bi bi-journal-arrow-up align-middle c-red-500"></i>
                                </span>
                                <span class="title">@lang('miscellaneous.menu.manager.infos')</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('party.infos') ? ' actived' : '' }}">
                                    <a href="{{ route('party.infos') }}">
                                        <span>@lang('miscellaneous.menu.home')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('party.infos.entity') AND $entity == 'news' OR Route::is('party.infos.entity.datas') AND $entity == 'news' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'news']) }}">
                                        <span>@lang('miscellaneous.manager.info.news.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('party.infos.entity') AND $entity == 'communique' OR Route::is('party.infos.entity.datas') AND $entity == 'communique' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'communique']) }}">
                                        <span>@lang('miscellaneous.manager.info.communique.title')</span>
                                    </a>
                                </li>

                                <li class="{{ Route::is('party.infos.entity') AND $entity == 'event' OR Route::is('party.infos.entity.datas') AND $entity == 'event' ? ' actived' : '' }}">
                                    <a href="{{ route('miscellaneous.entity.home', ['entity' => 'event']) }}">
                                        <span>@lang('miscellaneous.manager.info.event.title')</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
@endif
                    </ul>
                </div>
            </div>

            <!-- #Main ============================ -->
            <div class="page-container">
                <!-- ### $Topbar ### -->
                <div class="header navbar">
                    <div class="header-container">
                        <ul class="nav-left">
                            <li>
                                <a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);">
                                    <i class="ti-menu"></i>
                                </a>
                            </li>
                            <li class="search-box">
                                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                                    <i class="search-icon ti-search pdd-right-10"></i>
                                    <i class="search-icon-close ti-close pdd-right-10"></i>
                                </a>
                            </li>
                            <li class="search-input">
                                <input class="form-control" type="text" placeholder="@lang('miscellaneous.search')">
                            </li>
                        </ul>
              
                        <ul class="nav-right">
                            <li id="adminNotification" class="notifications{{ $current_user->notifications[0]->status->status_name == 'Non lue' ? ' dropdown' : '' }}">
                                <span class="counter bgc-red">{{ count($current_user->notifications) }}</span>
                                <a href="{{ route('notification.home') }}" id="notificationLink" class="dropdown-toggle no-after" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-bell fs-3 align-middle"></i>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="notificationLink">
                                    <li class="pX-20 pY-15 bdB">
                                        <i class="ti-bell pR-10"></i>
                                        <span class="fsz-sm fw-600 c-grey-900">Notifications</span>
                                    </li>
                                    <li>
                                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                            <li>
                                                <a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/2.jpg" alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <span>
                                                            <span class="fw-500">Moo Doe</span>
                                                            <span class="c-grey-600">liked your <span class="text-dark">cover image</span>
                                                        </span>
                                                        <p class="m-0">
                                                            <small class="fsz-xs">7 mins ago</small>
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pX-20 pY-15 ta-c bdT">
                                        <span>
                                            <a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                <li class="dropdown">
                  <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-bs-toggle="dropdown">
                    <div class="peer mR-10">
                      <img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt="">
                    </div>
                    <div class="peer">
                      <span class="fsz-sm c-grey-900">John Doe</span>
                    </div>
                  </a>
                  <ul class="dropdown-menu fsz-sm">
                    <li>
                      <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-settings mR-10"></i>
                        <span>Setting</span>
                      </a>
                    </li>
                    <li>
                      <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-user mR-10"></i>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="email.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-email mR-10"></i>
                        <span>Messages</span>
                      </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                      <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-power-off mR-10"></i>
                        <span>Logout</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>

@yield('app-content')

            </div>
        </div>

        <!-- ### $App Screen Footer ### -->
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
            <span>&copy; <a href="{{ route('about.party') }}" class="text-info">ACR</a> @lang('miscellaneous.all_right_reserved')</span>
        </footer>
    </body>
</html>
