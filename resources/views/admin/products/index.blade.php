@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            @isset($title)
                <li class="breadcrumb-item">
                    <a class="link-primary" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="breadcrumb-item text-capitalize">{{ $title }}</li>
            @else
                <li class="breadcrumb-item">Products</li>
            @endisset
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    @include('includes.admin.product_nav')
    <div class="container mt-5">
        <div class=" row">
            @forelse ($products as $p_item)
                <div class=" col-lg-4 col-md-6 col-12 p-1">
                    <div class="card p-0">
                        <div class="card-img-top position-relative"
                            style="height: 250px; background: url({{ asset($p_item->image) }}) no-repeat scroll center ; background-size: cover;">
                            <div class="position-absolute top-0 end-0">
                                @if ($p_item->view == 'hot')
                                    <span class="badge text-danger bg-light bg-opacity-75 fs-6  py-2">
                                        <i class="fa-brands fa-hotjar"></i>
                                    </span>
                                @endif
                                @if ($p_item->return == true)
                                    <span class="badge text-success bg-light bg-opacity-75 fs-6  py-2">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </span>
                                @endif
                                @if ($p_item->discount != 0)
                                    <span class="badge  bg-danger fs-6  py-2">
                                        <i class="fa-solid fa-arrow-down"></i> {{ $p_item->discount }}
                                        <i class="fa-solid fa-percent"></i>
                                    </span>
                                @endif
                            </div>
                            <div class="position-absolute bottom-0 start-0">
                                <span class="badge  text-primary bg-light bg-opacity-75 fs-6  py-2">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    @if ($p_item->discount == 0)
                                        {{ $p_item->price }}
                                    @else
                                        <span class="text-decoration-line-through text-danger">{{ $p_item->price }}</span>
                                        <span>{{ $p_item->price * (1 - $p_item->discount / 100) }}</span>
                                    @endif
                                </span>
                                @if ($p_item->quantity == 0)
                                    <span class="badge  text-danger bg-light bg-opacity-75 fs-6  py-2">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </span>
                                @else
                                    <span class="badge  text-success bg-light bg-opacity-75 fs-6  py-2">
                                        <i class="fa-solid fa-cubes"></i> {{ $p_item->quantity }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body mb-3">
                            <div class="text-end mb-2">
                                <div class="btn-group" role="group">
                                    <!-- Button trigger delet product modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete_productX{{ $p_item->id }}">
                                        <i class="fa-solid fa-trash"></i></button>
                                    <!--END Button-->
                                    <!-- Button Edit product -->
                                    <a href="{{ route('products.edit', $p_item->id) }}" class="btn btn-warning"">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!--END Button-->
                                    <!-- Button show product -->
                                    <a href="{{ route('products.show', $p_item->id) }}" class="btn btn-success">
                                        <i class="fa-sharp fa-solid fa-eye"></i></a>
                                    <!--END Button-->
                                </div>
                            </div>
                            <h5 class="card-title text-primary"><span
                                    class="bg-info me-2 p-1 text-primary bg-opacity-25 rounded">
                                    ID:{{ $p_item->id }}</span>
                                <span>{{ substr($p_item->name, 0, 30) . '....' }}</span>
                            </h5>
                            <p class="card-text">{{ substr($p_item->description, 0, 50) . '....' }}</p>
                            <div class="text-end">
                                <span class="d-inline-block  text-bg-info bg-opacity-25  p-2 rounded ">
                                    <i class="fa-solid fa-tags"></i>
                                    {{ $p_item->mainSubCategory->mainCategory->name }}
                                    / {{ $p_item->mainSubCategory->subCategory->name }}
                                </span>
                                <span class="d-inline-block  text-dark bg-success bg-opacity-25  p-2 rounded">
                                    sold# {{ $p_item->orderDetails->count() }}
                                </span>
                            </div>
                        </div>
                        <!-- Delete product Modal -->
                        <div class="modal fade" id="delete_productX{{ $p_item->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert">
                                            Danger! Are you sure to deleteing the product "{{ $p_item->name }}"
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                        <form class="btn" action="{{ route('products.destroy', $p_item->id) }}"
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
                    </div>
                </div>
            @empty
                <p>sorry, there are not Products</p>
            @endforelse
        </div>
    </div>
    @isset($title)
        @if (str_contains($title, 'popular'))
        @else
            <!--Pagination-->
            <div class="mt-5 d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
            <!--End Pagination-->
        @endif
    @else
        <!--Pagination-->
        <div class="mt-5 d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
        <!--End Pagination-->
    @endisset
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('activeLink');
            $('#products_link').addClass('activeLink');
        });
    </script>
@endsection
