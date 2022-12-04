@extends('layouts.app')
@section('title', 'Home')
@section('style')
    <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="front_content">
        <!-- header -->
        @include('includes.front.header')
        <!-- End header -->
        <!-- page -->
        <div class="" style="margin-top: 90px">
            @include('includes.message')
            @yield('page')
            @include('includes.front.footer')
        </div>
        <!--End page -->
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/js/front.js') }}"></script> --}}
@endsection
