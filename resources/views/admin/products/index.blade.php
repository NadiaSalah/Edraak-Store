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
                @include('includes.admin.productItem',['index'=>true])
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
