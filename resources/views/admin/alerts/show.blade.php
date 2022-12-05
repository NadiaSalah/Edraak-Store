@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link-primary" href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item " aria-current="page">
                <a class="link-primary" href="{{ route('products.show', $product->id) }}">
                    << Show</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">Alerts</li>
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    <div class="container my-5">
        <div class="card  my-3">
            <div class="card-header bg-warning">
                Aletrs - Product Details
            </div>
            <div class="card-body">
                <h4 class="card-title text-primary"><span class="bg-primary me-2 p-1 text-primary bg-opacity-25 rounded">
                        ID:{{ $product->id }}</span><span> name: {{ $product->name }}</span></h4>
                <h4><span class="badge text-bg-danger">Total number: # {{ count($product->productAlerts) }}</span></h4>
            </div>
        </div>
        <div>
            @forelse ($alerts = $product->productAlerts as $a_item)
                @include('includes.admin.alertItem')
            @empty
                <p>Sorry, No Alerts for the product "{{ $product->name }}" </p>
            @endforelse
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
