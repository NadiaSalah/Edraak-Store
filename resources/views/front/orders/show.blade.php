@extends('layouts.front')
@section('page')
    @include('includes.front.user_header')
    <div class="container my-5">
        <h2 class="  border-start border-3 border-primary ps-4">ORDER DETAILS</h2>
        <div class="card my-4">
            <h5 class="card-header text-bg-primary"><i class="fa-solid fa-dolly"></i> Order id#{{ $order->id }}
            </h5>
            <div class="card-body bg-primary p-3 text-dark bg-opacity-25">
                <span class=" d-inline-block  m-1"><strong class="text-primary">
                        <i class="fa-solid fa-calendar-plus"></i> Created at: </strong>
                    <i class="fa-solid fa-hashtag"></i>
                    {{ $order->created_at }}</span>
                <span class=" d-inline-block  m-1"><strong class="text-primary">
                        <i class="fa-solid fa-square-check"></i> Items: </strong>
                    <i class="fa-solid fa-hashtag"></i>
                    {{ $order->orderDetails->count() }}</span>
                <span class=" d-inline-block  m-1"><strong class="text-primary">
                        <i class="fa-solid fa-square-check"></i> Total quantity: </strong>
                    <i class="fa-solid fa-hashtag"></i>
                    {{ $order->total_quantity }}</span>
                <span class="d-inline-block  m-1"><strong class="text-primary">
                        <i class="fa-solid fa-square-check"></i> Final Price: </strong><i
                        class="fa-solid fa-dollar-sign"></i> {{ $order->final_price }}</span>
                        <div>
                            <h6 class="text-primary m-1">
                                <i class="fa-solid fa-truck-fast"></i> Shiping Details</h6>
                            @php
                                $a_item = $order->address;
                            @endphp
                            <p class="mx-3">
                                
                                    <i class="fa-solid fa-user"></i> {{ $order->user->first_name }}
                                    {{ $order->user->last_name }} /
                                    <i class="fa-solid fa-phone"></i> {{ $a_item->phone }} /
                                    <i class="fa-solid fa-location-dot"></i>
                                {{ $a_item->address_line_2 }},
                                {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                                {{ $a_item->country }} and {{ $a_item->postal_code }}
                            </p>
                        </div>
                        <a href="{{ route('orderDetails.index') }}" class="link-primary">All Orders >></a>

            </div>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @forelse ($order->orderDetails as $od_item)
                    @include('includes.front.orderDetailsItem')
                @empty
                    <p>Sorry, No Order Details for this Order id#{{ $order->id }}</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
