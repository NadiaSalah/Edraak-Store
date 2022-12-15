@extends('layouts.front')
@section('page')
    @include('includes.front.slider')
    <div class="">
        @include('includes.front.products-sec')
        @include('includes.front.hot-sec')
        @include('includes.front.sale-sec')
    </div>
@endsection
