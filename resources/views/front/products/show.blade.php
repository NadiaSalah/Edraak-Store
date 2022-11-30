@extends('layouts.front')
<!--page-->
@section('page')
    <div class="container my-5">
        <div class="card  shadow-sm m-auto my-5 " style="width: 25rem; max-width:100%;">
            <div class=" card-img-top rounded"
                style="min-height:400px; background: url({{ asset($product->image) }}) no-repeat scroll center ; background-size: cover;">
            </div>
        </div>
        <div class="card  mt-3">
            <div class="card-header bg-primary text-light">
                Add to cart
            </div>
            <div class="card-body bg-primary bg-opacity-25">
                <blockquote class="blockquote mb-0">
                    <div class="container py-2 m-auto" style="width: 25rem; max-width:100%;">
                        @if ($product->quantity != 0)
                            <div>
                                <form acrtion="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3 text-wrap ">
                                        @if ($product->discount == 0)
                                            <span class="input-group-text bg-success text-light">
                                                <i class="fa-solid fa-dollar-sign"></i>{{ $product->price }}
                                            </span>
                                        @else
                                            <span class="input-group-text bg-danger  text-light">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                                <span class="text-decoration-line-through">{{ $product->price }}</span>
                                                <span class="px-1">
                                                    {{ $product->price * (1 - $product->discount / 100) }}</span>
                                            </span>
                                        @endif
                                        <input name="productID" value="{{ $product->id }}" hidden required>
                                        <input name="number" type="number" min="1" step="1"
                                            max={{ $product->quantity }} class="form-control" placeholder="Product Numbers">
                                        <button class="btn btn-outline-primary" type="button"><i
                                                class="fa-solid fa-cart-plus"></i></button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="bg-danger p-2 text-danger bg-opacity-25 rounded mb-3">
                                <i class="fa-solid fa-circle-xmark"></i> Out of stock
                            </div>
                        @endif
                    </div>
                    <footer class="blockquote-footer">Product : Add to your cart</footer>
                </blockquote>
            </div>
        </div>
        <div class="card mt-3">
            <h5 class="card-header">Product Title and Details</h5>
            <div class="card-body">
                <h4 class="card-title text-primary">
                    <span class="bg-info me-2 p-1 text-primary bg-opacity-25 rounded">
                        ID:{{ $product->id }}</span>
                    <span>{{ $product->name }}</span>
                </h4>
                <h6 class=" mt-3 d-inline-block">
                    @if ($product->discount == 0)
                        <span class="bg-primary p-2 text-dark bg-opacity-25 rounded">
                            <i class="fa-solid fa-dollar-sign"></i>{{ $product->price }}
                        </span>
                    @else
                        <span class="bg-danger p-2 text-dark bg-opacity-25 rounded">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <span class="text-decoration-line-through">{{ $product->price }}</span>
                            <span>{{ $product->price * (1 - $product->discount / 100) }}</span>
                            <span> | <i class="fa-solid fa-arrow-down"></i> {{ $product->discount }}
                                %</span>
                        </span>
                    @endif
                </h6>
                <p class="card-text">
                <ul class="list-group list-group-flush w-100">
                    <li class="list-group-item">
                        <div class="">
                            <div class="mx-1 my-2 d-inline-block">
                                <span class="bg-primary p-2 text-primary bg-opacity-25 rounded-pill">
                                    {{ $product->mainSubCategory->mainCategory->name }}
                                    / {{ $product->mainSubCategory->subCategory->name }}
                                </span>
                            </div>
                            <div class="mx-1 my-2 d-inline-block">
                                @if ($product->quantity == 0)
                                    <span class="bg-danger p-2 text-danger bg-opacity-25 rounded-pill">
                                        <i class="fa-solid fa-circle-xmark"></i> Out of stock
                                    </span>
                                @else
                                    <span class="bg-success p-2 text-success bg-opacity-25 rounded-pill">
                                        <i class="fa-solid fa-cubes"></i> In stock: #{{ $product->quantity }}
                                    </span>
                                @endif
                            </div>
                            <div class="mx-1 my-2 d-inline-block">
                                <span class="bg-secondary p-2 text-dark bg-opacity-25 rounded-pill">
                                    @if ($product->return == 0)
                                        <i class="fa-solid fa-triangle-exclamation"></i> No return Policy
                                    @else
                                        <i class="fa-solid fa-rotate-left"></i> Return Policy
                                    @endif
                                </span>
                            </div>
                            <div class="mx-1 my-2 d-inline-block">
                                <span class="bg-warning p-2 text-dark bg-opacity-25 rounded-pill">
                                    <i class="fa-solid fa-people-group"></i>
                                    @forelse ($product->sizes as $s_item)
                                        @if ($s_item->name != 'no')
                                            {{ $s_item->name }},
                                        @else
                                            No Sizes
                                        @endif
                                    @empty
                                        No Sizes
                                    @endforelse
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
                </p>
            </div>
        </div>
        <div class="card  mt-3">
            <div class="card-header">
                Description
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endsection
<!--ENDpage-->
