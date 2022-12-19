@extends('layouts.admin')
<!--title-->
@section('page_title', 'Dashboard / Reports')
<!--End title-->
<!--page-->
@section('page')
    <div class="container text-center my-5">
        <div class="border rounded bg-light p-4 my-3">
            <h3 class="text-start py-2 text-muted">Categories</h3>
            <div class="row  row-cols-auto">
                <div class="col text-bg-primary card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-tags"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getMainCategories()->count() }} </h3>
                            <a href="{{ route('mainCategories.index') }}" class="stretched-link">Main Categories</a>
                        </div>
                    </div>
                </div>
                <div class="col text-bg-success card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-tag"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getSubCategories()->count() }}</h3>
                            <a href="{{ route('subCategories.index') }}" class="stretched-link">Subcategories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded bg-light p-4 my-3">
            <h3 class="text-start py-2 text-muted">Products</h3>
            <div class="text-start">
                <a href="{{ route('products.popular') }}" class="btn btn-outline-primary btn-lg mb-3">Popular Products</a>
            </div>
            <div class="row  row-cols-auto">
                <div class="col text-bg-primary card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-store"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getProducts()->total() }}</h3>
                            <a href="{{ route('products.index') }}" class="stretched-link">Products</a>
                        </div>
                    </div>
                </div>
                <div class="col text-bg-warning card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-store"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getProductsArchived()->count() }}</h3>
                            <a href="{{ route('products.archive') }}" class="stretched-link">Archive</a>
                        </div>
                    </div>
                </div>
                <div class="col text-bg-danger card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-triangle-exclamation"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getAlerts()->total() }}</h3>
                            <a href="{{ route('productAlerts.index') }}" class="stretched-link">Alerts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded bg-light p-4 my-3">
            <h3 class="text-start py-2 text-muted">Orders</h3>
            <div class="row  row-cols-auto">
                <div class="col text-bg-primary card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-bag-shopping"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getOrderDetails()->count() }}</h3>
                            <a href="{{ route('orders.index') }}" class="stretched-link">Orders</a>
                        </div>
                    </div>
                </div>
                @foreach (getOrderStatus(null) as $s_key => $s_value)
                    @php $class=  orderStatusCalss($s_key) ; @endphp
                    <div class="col text-bg-{{ $class }} card m-2">
                        <div class="d-flex p-3 align-items-center">
                            <h4 class="pe-3"><i class="fa-solid fa-bag-shopping"></i></h4>
                            <div class="fs-4">
                                <h3> {{ $s_value }} </h3>
                                <a href="{{ route('orders.show', $s_key) }}" class="stretched-link text-capitalize">
                                    {{ $s_key }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col text-bg-primary card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-bag-shopping"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getmonthOrderDetails()->count() }}</h3>
                            <a href="{{ route('orders.show', 'month') }}" class="stretched-link">
                                Current Month</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded bg-light p-4 my-3">
            <h3 class="text-start py-2 text-muted">Users</h3>
            <div class="row  row-cols-auto">
                <div class="col text-bg-primary card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-user-group"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getUsers()->count() }}</h3>
                            <a href="{{ route('users.index') }}" class="stretched-link">Users</a>
                        </div>
                    </div>
                </div>
                <div class="col text-bg-success card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-user-group"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getActivedUsers()->count() }}</h3>
                            <a href="{{ route('users.actived') }}" class="stretched-link">Actived</a>
                        </div>
                    </div>
                </div>
                <div class="col text-bg-danger card m-2">
                    <div class="d-flex p-3 align-items-center">
                        <h4 class="pe-3"><i class="fa-solid fa-user-group"></i></h4>
                        <div class="fs-4">
                            <h3>{{ getBlockedUsers()->count() }}</h3>
                            <a href="{{ route('users.blocked') }}" class="stretched-link">Blocked</a>
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
            $('a.link').removeClass('activeLink');
            $('#dashboard_link').addClass('activeLink');
        });
    </script>

@endsection
