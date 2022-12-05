@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link-primary" href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item " aria-current="page">Alerts</li>
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    <div class="container my-5">
        @forelse ($alerts as $a_item)
           @include('includes.admin.alertItem')
        @empty
            <p>Sorry, No Alerts.</p>
        @endforelse
        <!--Pagination-->
        <div class="mt-5 d-flex justify-content-center">
            {!! $alerts->links() !!}
        </div>
        <!--End Pagination-->
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
