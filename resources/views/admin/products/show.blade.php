@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link-primary" href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item " aria-current="page">Show</li>
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    <div class="container my-5">
        <div class="card  shadow-sm m-auto my-5 " style="width: 25rem; max-width:100%;" >
            <div class=" card-img-top rounded"
                style="min-height:400px; background: url({{ asset($product->image) }}) no-repeat scroll center ; background-size: cover;">
            </div>
        </div>
        <div class="card mt-3">
            <h5 class="card-header">Product Title and Details</h5>
            <div class="card-body">
                <h4 class="card-title text-primary"><span
                    class="bg-info me-2 p-1 text-primary bg-opacity-25 rounded">
                    ID:{{ $product->id }}</span><span>{{ $product->name }}</span></h4>
                <p class="card-text">
                <ul class="list-group list-group-flush  w-100">
                    <li class="list-group-item">
                        <div class="">
                            <div class="mx-1 my-2 d-inline-block">
                                <span class="bg-primary p-2 text-primary bg-opacity-25 rounded-pill">
                                    <i class="fa-solid fa-tags"></i>
                                    {{ getproductCategories($product->main_sub_category_id)->mainCategory->name }}
                                    | {{ getproductCategories($product->main_sub_category_id)->subCategory->name }}
                                </span>
                            </div>
                            <div class="mx-1 my-2 d-inline-block">
                                @if ($product->discount == 0)
                                    <span class="bg-warning p-2 text-dark bg-opacity-25 rounded-pill">
                                        <i class="fa-solid fa-dollar-sign"></i>{{ $product->price }}
                                    </span>
                                @else
                                    <span class="bg-info p-2 text-dark bg-opacity-25 rounded-pill">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                        <span class="text-decoration-line-through">{{ $product->price }}</span>
                                        <span>{{ $product->price * (1 - $product->discount / 100) }}</span>
                                        <span> | <i class="fa-solid fa-arrow-down"></i> {{ $product->discount }}
                                            %</span>
                                    </span>
                                @endif
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
                            @if ($product->view == 'hot')
                                <div class="mx-1 my-2  d-inline-block">
                                    <span class="bg-danger p-2 text-danger bg-opacity-25 rounded-pill">
                                        <i class="fa-brands fa-hotjar"></i> Hot view
                                    </span>
                                </div>
                            @endif
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
        <div class="card  mt-3">
            <div class="card-header">
                Actions
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div class="text-end mb-2">
                        <div class="btn-group" role="group">
                            <!-- Button trigger delet product modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete_productX{{ $product->id }}">
                                <i class="fa-solid fa-trash"></i></button>
                            <!--END Button-->
                            <!-- Button Edit product -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"">
                                <i class="fa-solid fa-pen-to-square"></i></a>
                            <!--END Button-->
                        </div>
                    </div>
                    <footer class="blockquote-footer">Product : Delete,Edit</footer>
                </blockquote>
                <!-- Delete product Modal -->
                <div class="modal fade" id="delete_productX{{ $product->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert">
                                    Danger! Are you sure to deleteing the product "{{ $product->name }}"
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                <form class="btn" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('active');
            $('#products_link').addClass('active');
        });
    </script>
@endsection
