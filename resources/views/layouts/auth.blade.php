@extends('layouts.app') 
@section('title','Authentication')
@section('style')
<link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">  
@endsection
@section('content')

<div class="container">
  <div class=" d-flex  shadow rounded  bg-white  auth">
    <div class=" auth_img ">
    </div>
    <div class="auth_content px-4 py-5">
      <div class="">
        <a href="/" class="logo"> 
          <img src="{{ asset('assets/images/front/logo.jpg')}}" class="img-fluid " alt="logo">
        </a>
        @include('includes.message')
        <div class="auth_form">
          @yield('page')
        </div>
        <div class="mt-3">
          <a href="{{route('website')}}" class="link-primary ">Go to Home ></a>
        </div>
      </div>
    </div>
  </div>
</div>   
@endsection
