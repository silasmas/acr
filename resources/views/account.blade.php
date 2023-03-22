@extends('layouts.errors')

@section('errors-content')

        <!-- Account Start -->
        <div class="container-xxl py-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row mb-sm-5 mb-4 border-bottom border-secondary">
                    <div class="col-lg-3 col-sm-4 col-8 mx-auto pt-lg-4 pt-3">
                        <div class="bg-image mb-sm-5 mb-4 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/logo-text.png') }}" alt="ACR" class="img-fluid">
                            <div class="mask"><a href="{{ route('home') }}"></a></div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h1 class="display-1 fw-bold acr-text-red-2 text-uppercase">Votre profile</h1>
                        <h1 class="mb-4">Espace en construction</h1>
                        <p class="mb-4">Pour le moment, retournez sur votre appli mobile</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Account End -->
@endsection
