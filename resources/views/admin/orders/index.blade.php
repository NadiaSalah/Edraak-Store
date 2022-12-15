@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            @isset($title)
                <li class="breadcrumb-item">
                    <a class="link-primary" href="{{ route('orders.index') }}">Orders</a>
                </li>
                <li class="breadcrumb-item text-capitalize">{{ $title }}</li>
            @else
                <li class="breadcrumb-item">Orders</li>
            @endisset
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    <!--nav-->
    @include('includes.admin.order_nav')
    <!--end nav-->
    <div class="my-5">
        @forelse ($orderDetails as $od_item)
            @include('includes.admin.orderDetailsItem', ['index' => true])
        @empty
            <p>Sorry ,No @isset($title)
                    {{ $title }}
                @endisset Orders.</p>
        @endforelse
    </div>
    <!--Pagination-->
    <div class="mt-5 d-flex justify-content-center">
        {!! $orderDetails->links() !!}
    </div>
    <!--End Pagination-->
    <!--page-->
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('activeLink');
            $('#orders_link').addClass('activeLink');
        });
    </script>
@endsection
