@extends('layouts.front')
@section('page')
    <div class="container my-5">
       @include('includes.front.user_header')
        <div class="container mt-5">
            <h2 class="  border-start border-3 border-primary ps-4"> CART PRODUCTS</h2>
            <div class=" row mt-5">
                @forelse ($carts as $c_item)
                    @php $p_item = $c_item->productSizeItem->product; @endphp
                    @include('includes.front.productItem', ['size' => $c_item->productSizeItem->size])
                    <!-- Delete cart Modal -->
                    <div class="modal fade" id="delete_cartX{{ $c_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to deleteing the Product "{{ $p_item->name }}" from your cart.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <form class="btn" action="{{ route('carts.destroy', $c_item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                @empty
                    <p>Sorry, Your Cart is Empty</p>
                    <a href="{{ route('website') }}" class="link-primary">Add Products >></a>
                @endforelse
                <!--Pagination-->
                <div class="mt-5 d-flex justify-content-center">
                    {!! $carts->links() !!}
                </div>
                <!--End Pagination-->
            </div>
            @if ($carts->total() > 0)
                <div class="my-3 text-end">
                    <a href="{{route('carts.create')}}" class="btn btn-success">
                        <i class="fa-solid fa-clipboard-check"></i> Create Order
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
