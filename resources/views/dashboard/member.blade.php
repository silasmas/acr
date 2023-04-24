@extends('layouts.app')

@section('app-content')

    @if (Route::is('message.datas'))
                        <div class="row gap-20">
                            <div class="masonry-sizer col-md-6"></div>
                        </div>
    @else
                        <div class="row gap-20">
                            <div class="masonry-sizer col-md-6"></div>
                        </div>
    @endif

@endsection
