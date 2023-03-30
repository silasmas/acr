<?php
$current_user = session()->get('current_user');
?>
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
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/jquery/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/cropper/css/cropper.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/dairy/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/dairy/owlcarousel/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/dairy/lightbox/css/lightbox.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/addons/custom/mdb/css/mdb.min.css') }}">
        <!-- Dairy CSS File -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.dairy.css') }}">
        <!-- Custom CSS File -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.custom.css') }}">

        <title>
@if (Route::is('home'))
            @lang('miscellaneous.slogan')
@endif

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

@if (Route::is('notification'))
            @lang('miscellaneous.menu.notifications')
@endif

@if (Route::is('about.home'))
            @lang('miscellaneous.menu.public.about')
@endif

@if (Route::is('news.home'))
            @lang('miscellaneous.menu.public.news')
@endif

@if (Route::is('works'))
            @lang('miscellaneous.menu.public.works')
@endif

@if (Route::is('donate'))
            @lang('miscellaneous.menu.public.donate')
@endif

        </title>
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-0">
            <div class="row g-0 d-none d-lg-flex">
                <div class="col-lg-6 ps-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center text-light">
                        <span>@lang('miscellaneous.follow_us')</span>
                        <a href="https://web.facebook.com/profile.php?id=100088148853298" class="btn btn-floating btn-outline-light ms-2 border-1 fs-6 text-light shadow-0" style="border-width: 1px;"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/AcrRdc01" class="btn btn-floating btn-outline-light ms-2 border-1 fs-6 text-light shadow-0" style="border-width: 1px;"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/@NDEKOELIEZERTOKOKOMA" class="btn btn-floating btn-outline-light ms-2 border-1 fs-6 text-light shadow-0" style="border-width: 1px;"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <div class="h-100 bg-warning d-inline-flex align-items-center text-black py-2 px-4">
                        <span class="me-2 fw-semi-bold"><i class="fa fa-phone-alt me-2"></i>@lang('miscellaneous.call_us')</span>
                        <span>+243 810 503 074</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
            <a href="./" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/img/logo-text.png') }}" alt="ACR" width="210">
            </a>

            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link mt-1 {{ Route::is('home') ? 'active' : '' }}">@lang('miscellaneous.menu.home')</a>
                    <a href="{{ route('about.home') }}" class="nav-item nav-link mt-1 {{ Route::is('about.home') || Route::is('about.party') || Route::is('about.app') || Route::is('about.terms_of_use') || Route::is('about.privacy_policy') || Route::is('about.help') || Route::is('about.faq') ? 'active' : '' }}">@lang('miscellaneous.menu.public.about')</a>
                    <a href="{{ route('news.home') }}" class="nav-item nav-link mt-1 {{ Route::is('news.home') || Route::is('news.datas') ? 'active' : '' }}">@lang('miscellaneous.menu.public.news')</a>
                    <a href="{{ route('works') }}" class="nav-item nav-link mt-1 {{ Route::is('works') ? 'active' : '' }}">@lang('miscellaneous.menu.public.works')</a>
@empty(Auth::user())
                    <span class="nav-item dropdown d-lg-inline-block d-none mb-0">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown"><i class="bi bi-translate fs-4 align-top"></i></a>
                        <div class="dropdown-menu bg-light m-0 overflow-hidden align-top">
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
@endempty
                </div>
                <div class="border-start ps-lg-4 ps-0">
                    {{-- Notification --}}
@if (!empty(Auth::user()))
                    <div id="guestNotification" class="{{ $current_user->notifications[0]->status->status_name == 'Non lue' ? 'dropdown ' : '' }}d-inline-block my-3 ms-lg-0 ms-4 me-3">
                        <a role="button" href="{{ route('notification.home') }}" id="notificationLink" class="{{ $current_user->notifications[0]->status->status_name == 'Non lue' ? '' : 'text-secondary' }}" data-mdb-toggle="{{ $current_user->notifications[0]->status->status_name == 'Non lue' ? 'dropdown' : '' }}" aria-expanded="false">
                            <i class="bi {{ $current_user->notifications[0]->status->status_name == 'Non lue' ? 'bi-bell-fill ' : 'bi-bell ' }}fs-4 align-middle"></i>
    @if ($current_user->notifications[0]->status->status_name == 'Non lue')
                            <span class="position-absolute top-0 start-100 translate-middle p-1 border border-4 border-danger rounded-circle">
                                <span class="visually-hidden">@lang('miscellaneous.menu.notifications')</span>
                            </span>                            
    @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="notificationLink">
                            <li class="text-center">
                                <a id="markAllRead" href="#" class="dropdown-item py-3" style="background-color: #e0e0e0;" data-user-id="{{ $current_user->id }}">
                                    <i class="far fa-circle me-2"></i>@lang('miscellaneous.mark_all_read')
                                </a>
                            </li>
    @foreach ($current_user->notifications as $notification)
        @if (count($current_user->notifications) < 4)
                            <li class="border-bottom border-secondary" style="width: 15rem;">
                                <a href="{{ $notification->notification_url }}" class="dropdown-item py-3 text-wrap">
                                    <p class="m-0 text-black acr-line-height-1_45">{{ $notification->notification_content }}</p>
                                    <small class="text-secondary">{{ $notification->created_at }}</small>
                                </a>
                            </li>
        @endif
    @endforeach
                            <li class="text-center">
                                <a href="{{ route('notification.home') }}" class="dropdown-item py-3 acr-bg-blue-transparent text-light">
                                    @lang('miscellaneous.see_more')
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Avatar --}}
                    <div id="avatar" class="dropdown d-inline-block my-3 ms-lg-0 me-1">
                        <a role="button" href="" id="avatarLink" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname }}" width="40" class="rounded-circle me-2">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="avatarLink">
                            <li class="d-lg-flex d-none justify-content-center pt-3" style="background-color: #e0e0e0;">
                                <div class="bg-image">
                                    <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" width="70" class="img-thumbnail rounded-circle me-2">
                                    <div class="mask"></div>
                                </div>
                            </li>
                            <li class="d-lg-block d-none px-3 pt-3 pb-2 text-center" style="background-color: #e0e0e0;">
                                <h5 class="h5 mb-1 fw-bold text-truncate" style="width: 10rem;">{{ $current_user->firstname . ' ' . $current_user->lastname }}</h5>
                            </li>
                            <li class="border-bottom border-secondary">
                                <a href="{{ route('account') }}" class="dropdown-item py-3">
                                    <i class="bi bi-gear me-3"></i>@lang('miscellaneous.menu.account_settings')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item py-3">
                                    <i class="bi bi-power me-3"></i>@lang('miscellaneous.logout')
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('donate') }}" class="btn d-sm-inline-block d-block acr-btn-blue mb-sm-0 mb-4 align-middle rounded-pill shadow-0">@lang('miscellaneous.menu.public.donate')</a>
@else
                    <a href="{{ route('login') }}" class="btn d-sm-inline-block d-block acr-btn-outline-blue me-sm-2 me-0 mb-sm-0 mb-2 rounded-pill shadow-0">@lang('miscellaneous.menu.login')</a>
                    <a href="{{ route('donate') }}" class="btn d-sm-inline-block d-block acr-btn-blue mb-sm-0 mb-4 rounded-pill shadow-0">@lang('miscellaneous.menu.public.donate')</a>
@endif
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

@yield('guest-content')

        <!-- Footer Start -->
        <div class="container-fluid acr-bg-blue-gray footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-4">
                <div class="row g-5">
                    <div class="col-lg-5 col-md-6">
                        <h5 class="text-white mb-4">@lang('miscellaneous.public.footer.head_office.title')</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>@lang('miscellaneous.public.footer.head_office.address')</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>@lang('miscellaneous.public.footer.head_office.phone')</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>@lang('miscellaneous.public.footer.head_office.email')</p>
                        <div class="d-flex pt-3">
                            <a href="https://web.facebook.com/profile.php?id=100088148853298" class="btn btn-floating btn-outline-light border border-light me-3"><i class="fab fa-facebook-f fs-6"></i></a>
                            <a href="https://twitter.com/AcrRdc01" class="btn btn-floating btn-outline-light border border-light me-3"><i class="fab fa-twitter fs-6"></i></a>
                            <a href="https://www.youtube.com/@NDEKOELIEZERTOKOKOMA" class="btn btn-floating btn-outline-light border border-light me-3"><i class="fab fa-youtube fs-6"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">@lang('miscellaneous.public.footer.useful_links')</h5>
                        <a href="{{ route('about.home') }}" class="btn btn-link bg-transparent fs-6">@lang('miscellaneous.menu.public.about')</a>
                        <a href="{{ route('news.home') }}" class="btn btn-link bg-transparent fs-6">@lang('miscellaneous.menu.public.news')</a>
                        <a href="{{ route('works') }}" class="btn btn-link bg-transparent fs-6">@lang('miscellaneous.menu.public.works')</a>
                        <a href="{{ route('donate') }}" class="btn btn-link bg-transparent fs-6">@lang('miscellaneous.menu.public.donate')</a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-white mb-4">@lang('miscellaneous.public.footer.newsletter.title')</h5>
                        <p>@lang('miscellaneous.public.footer.newsletter.text')</p>
                        <div class="position-relative w-100">
                            <form action="" method="post">
                                <input type="text" class="form-control bg-transparent w-100 py-3 ps-4 pe-5 text-white" placeholder="@lang('miscellaneous.public.footer.newsletter.email')">
                                <button type="submit" class="btn btn-secondary text-primary position-absolute top-0 end-0 mt-2 me-2" style="padding: 0.8rem 0.8rem;">@lang('miscellaneous.public.footer.newsletter.submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid bg-dark text-body copyright py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0 text-center text-md-start text-secondary">
                        &copy; <a href="{{ route('about.party') }}" class="text-info">ACR</a> @lang('miscellaneous.all_right_reserved')
                    </div>
                    <div class="col-md-6 text-center text-md-end text-secondary">
                        Designed By <a href="https://www.silasdev.com" class="text-info">SILASDEV</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg acr-btn-yellow btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="{{ asset('assets/addons/custom/jquery/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/jquery/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/mdb/js/mdb.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/cropper/js/cropper.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/autosize/js/autosize.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/wow/wow.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/parallax/parallax.min.js') }}"></script>
        <script src="{{ asset('assets/addons/dairy/lightbox/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('assets/addons/custom/biliap/js/biliap.cores.js') }}"></script>

        <!-- Dairy Javascript -->
        <script src="{{ asset('assets/js/scripts.dairy.js') }}"></script>
        <!-- Custom Javascript -->
        <script src="{{ asset('assets/js/scripts.custom.js') }}"></script>
    </body>
</html>
