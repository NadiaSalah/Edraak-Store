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
                    <!-- Button trigger creat modal -->
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addAddress">
                        <i class="fa-solid fa-plus"></i> Add Address
                    </button>
                    <!-- End Button-->
                </div>
            </div>
        </div>
        <!-- add address Modal -->
        <div class="modal fade" id="addAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-light">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <input name="userID" type="text" class="form-control" value="{{$user->id}}"
                                required hidden>
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                                        required>
                                    <div class="form-text">for multiple adresses.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input name="phone" type="tel" class="form-control" value="{{ old('phone') }}"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address Line 1</label>
                                    <input name="address_line_1" type="text" class="form-control"
                                        placeholder="1234 Main St" value="{{ old('address_line_1') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address Line 2</label>
                                    <input name="address_line_2" type="text" class="form-control"
                                        placeholder="Apartment, studio, or floor" value="{{ old('address_line_2') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input name="city" type="text" class="form-control" value="{{ old('city') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">State</label>
                                    <input name="state" type="text" class="form-control" value="{{ old('state') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">country</label>
                                    <input name="country" type="text" class="form-control" value="{{ old('country') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input name="postal_code" type="text" class="form-control"
                                        value="{{ old('postal_code') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <div class="card my-4">
            <div class="card-header bg-info text-dark">
                Dashboard
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div class="my-2">
                        <a href="{{ route('addresses.index') }}" class="m-1 btn btn-success text-light">
                            <i class="fa-solid fa-house-circle-check"></i> Adresses
                            <span class="badge text-bg-danger fs-6 mx-1">{{count($user->addresses)}}</span>
                        </a>
                        <a href="{{ route('carts.index') }}" class="m-1 btn btn-warning text-dark">
                            <i class="fa-solid fa-cart-shopping"></i> Cart
                            <span class="badge text-bg-danger fs-6 mx-1">{{count($user->carts)}}</span>
                        </a>
                        <a href="#" class="m-1 btn btn-primary text-light">
                            <i class="fa-solid fa-dolly"></i> Orders
                            <span class="badge text-bg-danger fs-6 mx-1">{{count($user->orders)}}</span>
                        </a>
                    </div>
                    <footer class="blockquote-footer my-2">control your: addresses, cart, orders </cite></footer>
                </blockquote>
            </div>
        </div>

    </div>
@endsection
<!--ENDpage-->
