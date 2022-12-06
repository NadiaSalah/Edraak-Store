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
                <div class="rounded">
                    <h5 class="text-primary m-1"><i class="fa-solid fa-location-dot"></i> Address</h5>
                    @php
                        $a_item = $order->address;
                    @endphp
                    <p class="mx-3">{{ $a_item->name }} - {{ $a_item->phone }} / {{ $a_item->address_line_2 }},
                        {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                        {{ $a_item->country }} and {{ $a_item->postal_code }}</p>
                    <a href="{{ route('orderDetails.index') }}" class="link-success m-1">Orders >></a>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($order->orderDetails as $od_item)
                <ul class="list-group col-auto m-2">
                    <li class="list-group-item text-bg-info">
                        Item id#{{ $od_item->id }}
                    </li>
                    <li class="list-group-item list-group-item-info">
                        Item : {{ $od_item->productSize->product->name }}
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Item Price
                        <span class="badge bg-danger rounded-pill fs-6">
                            <i class="fa-solid fa-dollar-sign"></i> {{ $od_item->price }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Quantity
                        <span class="badge bg-danger rounded-pill fs-6">
                            <i class="fa-solid fa-hashtag"></i> {{ $od_item->quantity }}</span>
                    </li>
                    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center">
                        Total Price
                        <span class="badge bg-danger rounded-pill fs-6">
                            <i class="fa-solid fa-dollar-sign"></i> {{ $od_item->total_price }}</span>
                    </li>
                    <li class="list-group-item list-group-item-warning">
                        Status : {{ $od_item->status }}
                    </li>
                </ul>
            @empty
                <p>Sorry, No Order Details for this Order id#{{ $order->id }}</p>
            @endforelse
        </div>
    </div>
@endsection
