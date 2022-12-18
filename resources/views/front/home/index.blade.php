@extends('layouts.front')
@section('page')
    @include('includes.front.slider')
    <div class="">
        @include('includes.front.products-sec')
        @include('includes.front.hot-sec')
        @include('includes.front.sale-sec')
        @include('includes.front.premium-sec')
        @auth
            @if(Auth::User()->role == 1)
            @include('includes.front.recommended-sec')
            @endif
        @endauth
    </div>
@endsection
