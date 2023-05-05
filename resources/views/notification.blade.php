@extends('layouts.guest')

@section('guest-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .6), rgba(45, 62, 88, 0.6)), url({{ asset('assets/img/gallery/gallery-5.png') }}) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.menu.notifications')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.menu.notifications')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- News details Start -->
        <div class="container-xxl py-4">
            <div class="container">
                <div class="col-12">
                    <div class="list-group element" style="padding-left: 0;">
    @forelse ($current_user->notifications as $notification)
        @if ($notification->notif_name == 'notification')
                        <a href="/{{ $notification->notification_url }}" class="list-group-item list-group-item-action py-3">
                            <p class="m-0 text-black acr-line-height-1_45">{{ $notification->notification_content }}</p>
                            <small class="text-secondary small">{{ $notification->created_at }}</small>
                        </a>
        @endif
    @empty
    @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- News details End -->

@endsection
