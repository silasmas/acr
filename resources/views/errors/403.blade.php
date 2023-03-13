@extends('layouts.guest')

@section('guest-content')

            <!-- ============================================================== -->
            <!-- Page content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="row">
                        <div class="col-sm-5 col-6 mx-auto pt-lg-4 pt-3">
                            <div class="bg-image mb-sm-4 mb-3 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/logo-text.png') }}" alt="Biliap" class="img-fluid">
                                <div class="mask"><a href="{{ route('home') }}" class="stretched-link"></a></div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================== -->
                    <!-- error message block -->
                    <!-- ============================================================== -->
                    <div class="card border border-default py-sm-4 py-3 shadow-0">
                        <div class="card-body text-center">
                            <h1 class="display-1 blp-pink-text">403</h1>
                            <h2 class="h2 mb-4 fw-bold">{{ __('notifications.403_title') }}</h2>
                            <p class="lead mb-4">{{ __('notifications.403_description') }}</p>
                            <h4><a href="{{ route('home') }}">{{ __('miscellaneous.back_home') }}</a></h4>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End error message block -->
                    <!-- ============================================================== -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
@endsection
