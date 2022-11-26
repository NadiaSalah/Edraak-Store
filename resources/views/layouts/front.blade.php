@extends('layouts.app')
@section('title','Home')
@section('style')
    <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- aside -->
    {{-- @include('includes.front.aside') --}}
    <!-- End aside -->
    <div class="front_content">
        <!-- header -->
        {{-- @include('includes.front.header') --}}
        <!-- End header -->
        <!-- page -->
        
            <div class="container pt-2">
                <h3 class="my-3">@yield('page_title')</h3>
                @include('includes.message')
                @yield('page')
            </div>
  
        <!--End page -->
    </div>
@endsection
@section('script')
    {{-- <script src="{{ asset('assets/js/front.js') }}"></script> --}}
@endsection
