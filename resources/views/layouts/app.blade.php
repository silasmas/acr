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
    @if (Route::is('admin'))
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
    @if (Route::is('developer'))
            @lang('miscellaneous.developer.home.title')
    @endif

    @if (Route::is('apis.home') || Route::is('apis.entity'))
            @lang('miscellaneous.menu.developer.apis')
    @endif
@endif

{{-- Manager titles --}}
@if ($current_user->role_users[0]->role->role_name == 'Manager')
    @if (Route::is('manager'))
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

@yield('app-content')

        <!-- ### $App Screen Footer ### -->
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
            <span>&copy; <a href="{{ route('about.party') }}" class="text-info">ACR</a> @lang('miscellaneous.all_right_reserved')</span>
        </footer>
    </body>
</html>
