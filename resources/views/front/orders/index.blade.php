@extends('layouts.front')
@section('page')
    @include('includes.front.user_header')
    <div class="container my-5">
        <h2 class="  border-start border-3 border-primary ps-4 my-5">ORDERS</h2>
        @forelse ($orders as $o_item)
            <div class="card border-primary my-2">
                <div class="card-header bg-primary bg-opacity-50 border-primary fs-5">
                    Order id#{{ $o_item->id }}
                </div>
                <div class="card-body text-primary">
                    <div class="card-text">
                        <div class=" row align-items-start g-2 my-2">
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-bg-primary p-1 ">Created at</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $o_item->created_at }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-bg-primary p-1">Total Quantity</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">#{{ $o_item->total_quantity }}</span>
                            </div>
                            <div class="col-auto rounded-pill">
                                <span class="rounded-start text-bg-primary p-1">Final Price </span>
                                <span class="rounded-end bg-primary bg-opacity-25 text-dark p-1">
                                    <i class="fa-solid fa-dollar-sign"></i> {{ $o_item->final_price }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-bg-primary p-1">Payment</span>
                                <span class="rounded-end bg-primary bg-opacity-25 text-dark p-1">
                                    @if ($o_item->payment == 0)
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
                                    #{{ $o_item->orderDetails->count() }}
                                </span>
                            </div>
                            @forelse (getOrderStatus($o_item->id) as $st_key=>$st_value)
                                @if ($st_key == 'processing')
                                    @php
                                        $class = 'info';
                                    @endphp
                                @elseif($st_key == 'complete' || $st_key == 'delivered')
                                    @php
                                        $class = 'success';
                                    @endphp
                                @elseif($st_key == 'shipped')
                                    @php
                                        $class = 'warning';
                                    @endphp
                                @elseif($st_key == 'canceled')
                                    @php
                                        $class = 'danger';
                                    @endphp
                                @endif
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
                    </div>
                </div>
                <div class="card-footer bg-transparent border-primary text-end">
                    <a href="{{ route('orderDetails.show', $o_item->id) }}" class="btn btn-warning">
                        <i class="fa-solid fa-eye"></i> show</a>
                </div>
            </div>
        @empty
            <p>Sorry, No Orders for you </p>
            <a href="{{ route('website') }}" class="link-primary">Add Products >></a>
        @endforelse
        <!--Pagination-->
        <div class="mt-5 d-flex justify-content-center">
            {!! $orders->links() !!}
        </div>
        <!--End Pagination-->
    </div>
@endsection
