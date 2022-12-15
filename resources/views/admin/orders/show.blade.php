@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link-primary" href="{{ route('orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item ">Show</li>
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    <div class="container my-5">
        <div class="card">
            <h5 class="card-header text-bg-info">Main Order Details</h5>
            <div class="card-body">
                <h5 class="card-title text-primary">Main Order id# {{ $orderDetails->order->id }}</h5>
                <div class=" row align-items-start g-2 my-2">
                    <div class="col-auto rounded-pill ">
                        <span class=" rounded-start text-bg-primary p-1 ">Created at</span>
                        <span
                            class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $orderDetails->order->created_at }}</span>
                    </div>
                    <div class="col-auto rounded-pill ">
                        <span class=" rounded-start text-bg-primary p-1">Total Quantity</span>
                        <span
                            class="rounded-end bg-primary bg-opacity-25 text-dark p-1">#{{ $orderDetails->order->total_quantity }}</span>
                    </div>
                    <div class="col-auto rounded-pill">
                        <span class="rounded-start text-bg-primary p-1">Final Price </span>
                        <span class="rounded-end bg-primary bg-opacity-25 text-dark p-1">
                            <i class="fa-solid fa-dollar-sign"></i> {{ $orderDetails->order->final_price }}</span>
                    </div>
                    <div class="col-auto rounded-pill ">
                        <span class=" rounded-start text-bg-primary p-1">Payment</span>
                        <span class="rounded-end bg-primary bg-opacity-25 text-dark p-1">
                            @if ($orderDetails->order->payment == 0)
                                Cash
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row align-items-start g-2 my-2">
                    <div class="col-auto rounded-pill">
                        <span class=" rounded-start text-bg-primary p-1">
                            Items
                        </span>
                        <span class="rounded-end bg-primary bg-opacity-25 text-dark p-1">
                            #{{ $orderDetails->order->orderDetails->count() }}
                        </span>
                    </div>
                    @forelse (getOrderStatus($orderDetails->order->id) as $st_key=>$st_value)
                        @php $class=orderStatusCalss($st_key); @endphp
                        <div class="col-auto rounded-pill">
                            <span class=" rounded-start text-bg-{{ $class }} p-1">
                                {{ $st_key }}
                            </span>
                            <span class="rounded-end bg-{{ $class }} bg-opacity-25 text-dark p-1">
                                #{{ $st_value }}
                            </span>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="mt-4">
                    <h6 class="text-primary m-1">
                        <i class="fa-solid fa-truck-fast"></i> Shiping Details
                    </h6>
                    @php
                        $a_item = $orderDetails->order->address;
                    @endphp
                    <p class="mx-3">
                        <span class="text-success">
                            <i class="fa-solid fa-user"></i> {{ $orderDetails->order->user->first_name }}
                            {{ $orderDetails->order->user->last_name }}</span> /
                        <i class="fa-solid fa-phone"></i> {{ $a_item->phone }} /
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $a_item->address_line_2 }},
                        {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                        {{ $a_item->country }} and {{ $a_item->postal_code }}
                    </p>
                </div>
                <div class="mt-4">
                    <h6 class="text-primary m-1">
                        <i class="fa-solid fa-user"></i> User Details
                    </h6>
                    <p class="mx-3">
                        <span class="text-success">
                            id# {{ $orderDetails->order->user->id }} -
                            {{ $orderDetails->order->user->first_name }}
                            {{ $orderDetails->order->user->last_name }}</span> /
                        <i class="fa-solid fa-envelope-circle-check"></i> {{ $orderDetails->order->user->email }} /
                        Orders# {{ $orderDetails->order->user->orderDetails->count() }}
                        <a href="{{ route('orders.show',  $orderDetails->order->user->id) }}" class="btn btn-sm btn-warning mx-2">
                            <i class="fa-solid fa-eye"></i>
                        </a> /
                        Created at:{{ $orderDetails->order->user->created_at }} / status:
                        @if ($status = $orderDetails->order->user->status)
                            <span class="text-success">Active</span>
                        @else
                            <span class="text-danger">Block</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-3">
            <div class="alert alert-primary my-3" role="alert">
                All order id# {{ $orderDetails->order->id }} Items
            </div>
            @forelse ($orderDetails->order->orderDetails as $od_item)
                @include('includes.admin.orderDetailsItem')
            @empty
                <p>Sorry ,No OrderDetailss.</p>
            @endforelse
        </div>
    </div>
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('activeLink');
            $('#orders_link').addClass('activeLink');
        });
    </script>
@endsection
