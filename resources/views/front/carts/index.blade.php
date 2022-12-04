@extends('layouts.front')
@section('page')
    @include('includes.front.slider')
    <div class="container my-5">
        <div class="bg-info bg-opacity-25 my-5 py-3 px-3 text-dark border-start border-3 border-primary">
            <h6><span class="text-primary">user name: </span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}
            </h6>
            <h6><span class="text-primary">user email: </span>{{ Auth::User()->email }}</h6>
            <a href="{{ route('users.profile') }}" class="link-success">Goto Profile >>"</a>
        </div>
        <div class="container mt-5">
            <h2 class="  border-start border-3 border-primary ps-4"> CART PRODUCTS</h2>
            <div class=" row mt-5">
                @forelse ($carts as $c_item)
                    @php $p_item = $c_item->productSize->product; @endphp
                    @include('includes.front.productItem',['size'=>$c_item->productSize->size])
                    <!-- Delete cart Modal -->
                <div class="modal fade" id="delete_cartX{{ $c_item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert">
                                    Danger! Are you sure to deleteing the Product "{{ $p_item->name}}" from your cart.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                <form class="btn" action="{{ route('carts.destroy', $c_item->id) }}"
                                    method="POST">
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
                @endforelse
                <!--Pagination-->
                <div class="mt-5 d-flex justify-content-center">
                    {!! $carts->links() !!}
                </div>
                <!--End Pagination-->
            </div>
        </div>
    </div>
@endsection
