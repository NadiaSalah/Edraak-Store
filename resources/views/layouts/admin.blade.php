@extends('layouts.app')
@section('title')
admin
@endsection
@section('style')
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- aside -->
    @include('includes.admin.aside')
    <!-- End aside -->
    <div class=" admin admin_ml">
        <!-- header -->
        @include('includes.admin.header')
        <!-- End header -->
        <!-- page -->
        <div class="admin_content mb-5">
            <div class="container pt-2">
                <h3 class="my-3">@yield('page_title')</h3>
                @yield('page')
            </div>
        </div>
        <!--End page -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/admin.js') }}"></script>
@endsection
