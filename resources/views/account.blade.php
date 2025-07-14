@extends('layouts.guest')

@section('autres_style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.adminator.css') }}">
@endsection
@section('guest-content')

        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(25, 29, 35, .6), rgba(45, 62, 88, 0.6)), url({{ asset('assets/img/gallery/gallery-7.png') }}) top center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-4 animated slideInDown">@lang('miscellaneous.account.personal_infos.title')</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('home') }}" class="acr-text-yellow">@lang('miscellaneous.menu.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('miscellaneous.menu.account_settings')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Account Start -->
        <div class="container-xxl py-5 bg-light">
            <div class="container">
    @if ($current_user->status->status_name != 'Bloqué')
                <div class="row mb-4" style="margin-top: -8rem;">
                    <div class="col-lg-3 col-sm-4 col-7 mx-sm-0 mx-auto">
                        <div class="bg-image">
                            <img src="{{ $current_user->avatar_url != null ? $current_user->avatar_url : asset('assets/img/user.png') }}" alt="{{ $current_user->firstname . ' ' . $current_user->lastname }}" class="user-image img-fluid img-thumbnail rounded-circle">
                            <div class="mask">
                                <form class="position-absolute" method="post" style="bottom: 0.5rem; right: 0.5rem;">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                    <label for="avatar" class="btn btn-dark rounded-circle shadow-0" style="width: 2.6rem; height: 2.6rem; padding: 0.4rem 0.5rem; text-transform: inherit!important;" title="@lang('miscellaneous.change_image')">
                                        <span class="bi bi-pencil fs-5"></span>
                                        <input type="file" name="avatar" id="avatar" class="d-none">
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-12 d-sm-flex align-items-center text-sm-start text-center pt-sm-0 pt-2">
                        <div>
                            <h1 class="h1 mt-lg-0 mt-sm-4 mt-0 mb-0 text-black fw-bold">{{ $current_user->firstname . ' ' . $current_user->lastname }}</h1>
                            <p class="m-0 text-muted">{{ $current_user->role_user->role->role_name }}</p>
                        </div>
                    </div>                  
                </div>
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-12">
                        @include("parties.profilmembre")
                       
                    </div>
                </div>
    @else
                <div class="row wow fadeInUp" data-wow-delay="0.1s">
                    <div class="col-12 text-center">
                        <h1 class="h1 m-0 acr-text-red-2"><span class="bi bi-exclamation-triangle-fill me-2 align-middle"></span> @lang('miscellaneous.account.locked')</h1>
                    </div>
                </div>
    @endif
            </div>
        </div>
        <!-- Account End -->
@endsection
@section('autres_js')
<script>
    $(function () {
            $('#dataList').DataTable({
                language: {
                    url: currentHost + '/assets/addons/custom/dataTables/Plugins/i18n/' + $('html').attr('lang') + '.json'
                },
            });
            $('#rectoVersoText').click(function (e) {
                e.preventDefault();

                var rectoText = '<?= __("miscellaneous.recto") ?>';
                var versoText = '<?= __("miscellaneous.verso") ?>';

                if ($('#cardVerso').hasClass('d-none')) {
                    $('#cardVerso').removeClass('d-none');
                    $('#cardRecto').addClass('d-none');

                    $('#rectoVersoText span').text(rectoText);

                } else {
                    $('#cardVerso').addClass('d-none');
                    $('#cardRecto').removeClass('d-none');

                    $('#rectoVersoText span').text(versoText);
                }
            });
        });
</script>
@endsection