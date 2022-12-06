@extends('layouts.front')
@section('page')
        <div class="container my-5">
            <h2 class="  border-start border-3 border-primary ps-4">PRODUCTS INDEX</h2>
            <div class=" row mt-5">
                @forelse ($products as $p_item)
                @include('includes.front.productItem')
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
