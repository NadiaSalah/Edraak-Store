@extends('layouts.admin')
<!--title-->
@section('page_title', 'Products ')
<!--End title-->
<!--page-->
@section('page')
    @include('includes.admin.product_nav')
    <div class="container mt-5">
        <div class=" row">
            @forelse ($products as $p_item)
                <div class=" col-lg-4 col-md-6 col-12 p-1">
                    <div class="card p-0">
                        <div class="card-img-top"
                            style="height: 250px; background: url({{ asset($p_item->image) }}) no-repeat scroll center ; background-size: cover;">
                        </div>
                        <div class="card-body">
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
                            <h5 class="card-title text-primary">{{ substr($p_item->name, 0, 30) . '....' }}</h5>
                            <p class="card-text">{{ substr($p_item->description, 0, 50) . '....' }}</p>
                        </div>
                        <ul class="list-group list-group-flush py-3">
                            <li class="list-group-item">
                                <div class="">
                                    <div class="mx-1 my-2 d-inline-block">
                                        <span class="bg-primary p-2 text-primary bg-opacity-25 rounded-pill">
                                            <i class="fa-solid fa-tags"></i>
                                            {{ getproductCategories($p_item->main_sub_category_id)->mainCategory->name }}
                                            | {{ getproductCategories($p_item->main_sub_category_id)->subCategory->name }}
                                        </span>
                                    </div>
                                    <div class="mx-1 my-2 d-inline-block">
                                        @if ($p_item->discount == 0)
                                            <span class="bg-warning p-2 text-dark bg-opacity-25 rounded-pill">
                                                <i class="fa-solid fa-dollar-sign"></i>{{ $p_item->price }}
                                            </span>
                                        @else
                                            <span class="bg-info p-2 text-dark bg-opacity-25 rounded-pill">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                                <span class="text-decoration-line-through">$ {{ $p_item->price }}</span>
                                                <span> | $ {{ $p_item->price * (1 - $p_item->discount / 100) }}</span>
                                                <span> | <i class="fa-solid fa-arrow-down"></i> {{ $p_item->discount }}
                                                    %</span>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="mx-1 my-2 d-inline-block">
                                        @if ($p_item->quantity == 0)
                                            <span class="bg-danger p-2 text-danger bg-opacity-25 rounded-pill">
                                                <i class="fa-solid fa-circle-xmark"></i> Out of stock
                                            </span>
                                        @else
                                            <span class="bg-success p-2 text-success bg-opacity-25 rounded-pill">
                                                <i class="fa-solid fa-cubes"></i> In stock: #{{ $p_item->quantity }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="mx-1 my-2 d-inline-block">
                                        <span class="bg-secondary p-2 text-dark bg-opacity-25 rounded-pill">
                                            @if ($p_item->return == 0)
                                                <i class="fa-solid fa-triangle-exclamation"></i> No return Policy
                                            @else
                                                <i class="fa-solid fa-rotate-left"></i> Return Policy
                                            @endif
                                        </span>
                                    </div>
                                    <div class="mx-1 my-2 d-inline-block">
                                        <span class="bg-warning p-2 text-dark bg-opacity-25 rounded-pill">
                                            <i class="fa-solid fa-people-group"></i>
                                            @forelse ($p_item->sizes as $s_item)
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
                                    @if ($p_item->view == 'hot')
                                        <div class="mx-1 my-2  d-inline-block">
                                            <span class="bg-danger p-2 text-danger bg-opacity-25 rounded-pill">
                                                <i class="fa-brands fa-hotjar"></i> Hot view
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
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
            <div class="  my-5"> {{ $products->links() }}</div>
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
