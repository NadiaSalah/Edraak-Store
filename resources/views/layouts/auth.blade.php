@extends('layouts.app') 

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
          <img src="assets/images/front/logo.jpg" class="img-fluid " alt="logo">
        </a>
        @include('includes.error')
        <div class="auth_form">
          @yield('page')
        </div>
        <div class="mt-3">
          <a href="#" class="link-primary ">Go to Home ></a>
        </div>
      </div>
    </div>
  </div>
</div>   
@endsection
