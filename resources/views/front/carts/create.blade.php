@extends('layouts.front')
@section('page')
    @include('includes.front.user_header')
    <div class="container my-5">
        <form action="{{ route('orderDetails.store') }}" method="POST">
            @csrf
            <h2 class="  border-start border-3 border-primary ps-4">CREATE ORDER</h2>
            <div class="card my-4">
                <h5 class="card-header text-bg-primary"><i class="fa-solid fa-clipboard-list"></i> Invoice</h5>
                <div class="card-body bg-primary p-3 text-dark bg-opacity-25">
                    <span class=" d-inline-block  m-1"><strong>
                            <i class="fa-solid fa-square-check"></i> Total items quantity: </strong>
                        <i class="fa-solid fa-hashtag"></i>
                        {{ $invoice['quantity'] }}</span>
                    <span class="d-inline-block  m-1"><strong>
                            <i class="fa-solid fa-square-check"></i> Total Price: </strong><i
                            class="fa-solid fa-dollar-sign"></i> {{ $invoice['price'] }}</span>
                    <a href="{{ route('carts.index') }}" class="link-primary d-inline-block  m-1"> View your cart >></a>
                </div>
            </div>
            <div class="card my-4">
                <h5 class="card-header text-bg-info">
                    <i class="fa-solid fa-money-check-dollar"></i> Payment
                </h5>
                <div class="card-body">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="" disabled>
                        <label class="form-check-label">
                            Online
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="" checked disabled>
                        <input class="form-check-input" type="radio" name="payment" checked hidden value="0">
                        <label class="form-check-label">
                            Cash
                        </label>
                    </div>
                </div>
            </div>
            <div class="card  mt-5">
                <h5 class="card-header text-bg-info">
                    <i class="fa-solid fa-location-dot"></i> Select Address
                </h5>
                <div class="card-body p-3">
                    @if ($user->addresses->count() != 0)
                        <select class="form-select form-select-lg mb-3" name='addressID' required>
                            @foreach ($user->addresses as $a_item)
                                <option value="{{ $a_item->id }}">
                                    {{ $a_item->name }} - {{ $a_item->phone }} / {{ $a_item->address_line_2 }},
                                    {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                                    {{ $a_item->country }} and {{ $a_item->postal_code }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <p>Sorry, No Addresses for you.</p>
                    @endif
                    <!-- Button trigger create address modal -->
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addAddress">
                        <i class="fa-solid fa-plus"></i> Add Address
                    </button>
                    <!-- End Button-->
                </div>
            </div>
            @if ($user->addresses->count() != 0)
                <div class="text-end my-5">
                    <!-- Button trigger create Order modal -->
                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#createOrder">
                        <i class="fa-solid fa-bag-shopping"></i> Check Out
                    </button>
                    <!-- End Button-->
                </div>
                <!-- create Order Modal -->
                <div class="modal fade" id="createOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    Are you sure to confirm the order.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
    @include('includes.front.add_address')
@endsection
