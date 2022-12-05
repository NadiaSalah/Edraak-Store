@extends('layouts.admin')
<!--title-->
@section('page_title', 'Dashboard / Reports')
<!--End title-->
<!--page-->
@section('page')
    <div class="container text-center">
        <div class="row  row-cols-auto">
            <div class="col text-bg-success card m-2">
                <div class="d-flex p-3 align-items-center">
                    <h4 class="pe-3"><i class="fa-solid fa-tags"></i></h4>
                    <div class="fs-4">
                        <h3>{{getMainCategories()->count() }} / {{getSubCategories()->count() }}</h3>
                        <a href="{{ route('mainCategories.index') }}" class="stretched-link">Main/Sub Categories</a>
                    </div>
                </div>
            </div>
            <div class="col text-bg-primary card m-2">
                <div class="d-flex p-3 align-items-center">
                    <h4 class="pe-3"><i class="fa-solid fa-store"></i></h4>
                    <div class="fs-4">
                        <h3>{{getProducts()->total() }}</h3>
                        <a href="{{ route('products.index') }}" class="stretched-link">Products</a>
                    </div>
                </div>
            </div>
            <div class="col text-bg-warning card m-2">
                <div class="d-flex p-3 align-items-center">
                    <h4 class="pe-3"><i class="fa-solid fa-user-group"></i></h4>
                    <div class="fs-4">
                        <h3>{{getUsers()->count()}}</h3>
                        <a href="{{ route('products.index') }}" class="stretched-link">Users</a>
                    </div>
                </div>
            </div>
            <div class="col text-bg-danger card m-2">
                <div class="d-flex p-3 align-items-center">
                    <h4 class="pe-3"><i class="fa-solid fa-triangle-exclamation"></i></h4>
                    <div class="fs-4">
                        <h3>{{getAlerts()->total()}}</h3>
                        <a href="{{ route('productAlerts.index') }}" class="stretched-link">Alerts</a>
                    </div>
                </div>
            </div>
            <div class="col text-bg-primary card m-2">
                <div class="d-flex p-3 align-items-center">
                    <h4 class="pe-3"><i class="fa-solid fa-bag-shopping"></i></h4>
                    <div class="fs-4">
                        <h3>{{getAlerts()->total()}}</h3>
                        <a href="{{ route('productAlerts.index') }}" class="stretched-link">Orders</a>
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
            $('#dashboard_link').addClass('active');
        });
    </script>

@endsection
