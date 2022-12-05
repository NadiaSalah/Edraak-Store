@extends('layouts.admin')
<!--title-->
@section('page_title', 'Welcome Admin')
<!--End title-->
<!--page-->
@section('page')
    @php
         $user= Auth::user();
    @endphp
    <div class="card bg-wight shadow-sm">
        <h5 class="card-header bg-primary text-light">Admin Details</h5>
        <div class="row g-0">
            <div class="col-md-4 rounded">
                <img src="{{ asset('assets/images/front/logo-c.png') }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="card-body col-md-8 ps-5">
                <h6 class="card-title text-secondary">
                    <span class="text-primary">First Name : </span>{{ $user->first_name }}
                </h6>
                <h6 class="card-title text-secondary">
                    <span class="text-primary">Last Name : </span>{{ $user->last_name }}
                </h6>
                <p class="card-text">
                    <span class="badge bg-warning text-dark fs-6 me-2">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                    </span><span class="text-success">{{ $user->email }}</span>
                </p>   
            </div>
        </div>
    </div>
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('active');
            $('#dashboard_link').addClass('active');
        });
    </script>

@endsection
