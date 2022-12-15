@extends('layouts.front')
@section('page')
    @include('includes.front.user_header')
    <div class="container my-5">
        <h2 class="  border-start border-3 border-primary ps-4 my-5">ORDERS</h2>
        <ul class="nav nav-tabs mb-5 bg-light p-3">
            @php
                $class = '';
                $p_class = '';
                $s_class = '';
                $d_class = '';
                $cm_class = '';
                $cn_class = '';
            @endphp
            @isset($title)
                @php
                    if ($title == 'processing') {
                        $p_class = 'active';
                    } elseif ($title == 'shipped') {
                        $s_class = 'active';
                    } elseif ($title == 'delivered') {
                        $d_class = 'active';
                    } elseif ($title == 'complete') {
                        $cm_class = 'active';
                    } elseif ($title == 'canceled') {
                        $cn_class = 'active';
                    }
                @endphp
            @else
                @php
                    $class = 'active';
                @endphp
            @endisset
            <li class="nav-item">
                <a class="nav-link {{ $class }}" href="{{ route('orderDetails.index') }}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $p_class }}" href="{{ route('orderDetails.edit', 'processing') }}">Processing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $s_class }}" href="{{ route('orderDetails.edit', 'shipped') }}">Shipped</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $d_class }}" href="{{ route('orderDetails.edit', 'delivered') }}">Delivered</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $cm_class }}" href="{{ route('orderDetails.edit', 'complete') }}">Complete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $cn_class }}" href="{{ route('orderDetails.edit', 'canceled') }}">Canceled</a>
            </li>
        </ul>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-3">
                @forelse ($orderDetails as $od_item)
                    @include('includes.front.orderDetailsItem', ['status' => $title])
                @empty
            <p>Sorry, No <span class="text-capitalize col-12">{{ $title }}</span> Orders for you </p>
            <a href="{{ route('website') }}" class="link-primary col-12">Add Products >></a>
            @endforelse
        </div>
        </div>
        <!--Pagination-->
        <div class="mt-5 d-flex justify-content-center">
            {!! $orderDetails->links() !!}
        </div>
        <!--End Pagination-->
    </div>
@endsection
