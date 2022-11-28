@extends('layouts.front')
@section('page')
    @include('includes.front.aside')
    <div class="">
        <div class="container mt-5">
            <h2 class="  border-start border-3 border-primary ps-4">PRODUCTS INDEX</h2>
            <div class=" row mt-5">
                @forelse ($products as $p_item)
                    <div class=" col-lg-4 col-md-6 col-12 p-1">
                        <div class="card p-0">
                            <div class="card-img-top position-relative"
                                style="height: 250px; background: url({{ asset($p_item->image) }}) no-repeat scroll center ; background-size: cover;">
                                @if ($p_item->discount != 0)
                                    <span class="badge position-absolute top-0 end-0 bg-danger fs-6  py-2">
                                        <i class="fa-solid fa-arrow-down"></i> {{ $p_item->discount }} <i
                                            class="fa-solid fa-percent"></i>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                @endif
                            </div>
                            <div class="card-body" style="transform: rotate(0);">
                                <h5 class="card-title text-primary">{{ substr($p_item->name, 0, 30) . '....' }}</h5>
                                <p class="text-end m-0 p-0">
                                    @if ($p_item->discount == 0)
                                        <span class="bg-info p-2 text-dark bg-opacity-25 rounded me-2">
                                            <i class="fa-solid fa-dollar-sign"></i>{{ $p_item->price }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-primary p-2 text-dark bg-opacity-25 rounded border border-info me-2">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                            <span
                                                class="text-decoration-line-through text-danger">{{ $p_item->price }}</span>
                                            <span>{{ $p_item->price * (1 - $p_item->discount / 100) }}</span>
                                            <span class="text-success"></span>
                                        </span>
                                    @endif
                                    <!-- Button show product -->
                                    <a href="{{ route('productsFront.show', $p_item->id) }}"
                                        class="btn btn-warning stretched-link">
                                        <i class="fa-sharp fa-solid fa-eye"></i></a>
                                    <!--END Button-->
                                </p>
                            </div>
                            <div class="container py-2">
                                @if ($p_item->quantity != 0)
                                    <form acrtion="{{ route('carts.store') }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input name="productID" value="{{ $p_item->id }}" hidden required>
                                            <input name="number" type="number" min="1" step="1"
                                                max={{ $p_item->quantity }} class="form-control"
                                                placeholder="Product Numbers">
                                            <button class="btn btn-outline-primary" type="button"><i
                                                    class="fa-solid fa-cart-plus"></i></button>
                                        </div>
                                    </form>
                                @else
                                    <div class="bg-danger p-2 text-danger bg-opacity-25 rounded mb-3">
                                        <i class="fa-solid fa-circle-xmark"></i> Out of stock
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>sorry, there are not Products</p>
                @endforelse
                <!--Pagination-->
                <div class="mt-5 d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
                <!--End Pagination-->

            </div>
        </div>
    @endsection
