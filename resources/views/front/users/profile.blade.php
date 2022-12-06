@extends('layouts.front')
<!--page-->
@section('page')
    <div class="container my-5 ">
        <div class="card bg-wight shadow-sm">
            <h5 class="card-header bg-primary text-light">User Details</h5>
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
                    <!-- Button trigger create address modal -->
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addAddress">
                        <i class="fa-solid fa-plus"></i> Add Address
                    </button>
                    <!-- End Button-->
                </div>
            </div>
        </div>
        @include('includes.front.add_address')
        <div class="card my-4">
            <div class="card-header bg-info text-dark">
                Dashboard
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div class="my-2">
                        <a href="{{ route('addresses.index') }}" class="m-1 btn btn-success text-light">
                            <i class="fa-solid fa-house-circle-check"></i> Adresses
                            <span class="badge text-bg-danger fs-6 mx-1">{{ count($user->addresses) }}</span>
                        </a>
                        <a href="{{ route('carts.index') }}" class="m-1 btn btn-warning text-dark">
                            <i class="fa-solid fa-cart-shopping"></i> Cart
                            <span class="badge text-bg-danger fs-6 mx-1">{{ count($user->carts) }}</span>
                        </a>
                        <a href="{{route('orderDetails.index')}}" class="m-1 btn btn-primary text-light">
                            <i class="fa-solid fa-dolly"></i> Orders
                            <span class="badge text-bg-danger fs-6 mx-1">{{ count($user->orders) }}</span>
                        </a>
                    </div>
                    <footer class="blockquote-footer my-2">control your: addresses, cart, orders </cite></footer>
                </blockquote>
            </div>
        </div>

    </div>
@endsection
<!--ENDpage-->
