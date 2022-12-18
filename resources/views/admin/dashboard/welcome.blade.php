@extends('layouts.admin')
<!--title-->
@section('page_title', 'Welcome Admin')
<!--End title-->
<!--page-->
@section('page')
    @php
        $user = Auth::user();
    @endphp
    <div class="card bg-wight shadow-sm">
        <h5 class="card-header bg-primary text-light">Admin Details</h5>
        <div class="row g-0">
            <div class="col-md-4 rounded">
                <img src="{{ asset('assets/images/front/logo-c.png') }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="card-body col-md-8 ps-5">
                <h6 class="card-title text-Productsary">
                    <span class="text-primary">Categories Name : </span>{{ $user->Categories_name }}
                </h6>
                <h6 class="card-title text-Productsary">
                    <span class="text-primary">Last Name : </span>{{ $user->last_name }}
                </h6>
                <p class="card-text">
                    <span class="badge bg-warning text-dark fs-6 me-2">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                    </span><span class="text-success">{{ $user->email }}</span>
                </p>
                <div class=""><a href="{{ route('dashboard.reports') }}" class="btn btn-outline-primary btn-lg">Reports</a></div>
            </div>
        </div>
    </div>
    <!--instruction-->
    <div class="my-4">
        <nav class="navbar bg-light px-3 mb-3">
            <h4 class="navbar-brand">Instructions</h4>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading1">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Other</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#scrollspyHeading3">Orders</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading4">Users</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div data-bs-spy="scroll" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
            class="scrollspy-example bg-light p-4 rounded-2 " tabindex="0">
            <h4 id="scrollspyHeading1" class="text-primary border-start border-3 border-primary ps-2">Categories</h4>
            <p>
            <ul>
                <li>Categories and subcategories can be seen in a list.</li>
                <li>New categories and subcategories can be created.</li>
                <li>A category & A subcategory has Name.</li>
                <li>Categories and subcategories can be modified and deleted .</li>
                <li>Different categories cannot have the same name.</li>
                <li>Different subcategories that belong to the same </li>
                <li>Category cannot have the same name.</li>
                <li> Success messages will show after successful
                    addition, update, or deletion.</li>
                <li>Error messages will show after failed addition,
                    update, or deletion.</li>
                <li>A confirmation message will show upon attempting
                    deletion.</li>
                    <li>Admin can search categories main/sub by name.</li>
                    <li>Admin can list products for specific subcategory</li>
            </ul>
            </p>
            <h4 id="scrollspyHeading2" class="text-primary border-start border-3 border-primary ps-2">Products</h4>
            <p>
            <ul>
                <li>Products can be seen in a list.</li>
                <li>The list will be paginated, and will show 6 products per page.</li>
                <li>New products can be created.</li>
                <li>A product has Name, Description, Price, Image,Return policy case and Size 'optional' values are: S, M,
                    L, XL, or XXL</li>
                <li>A product can belong to many subcategories.</li>
                <li>Products can be modified. If a product’s price was
                    updated, it will not affect the orders that were
                    already created.</li>
                <li>Products can be deleted. If a product is not used inside
                    orders, it gets deleted. If it is used inside orders, it
                    will be soft-deleted. Soft deletion means that the
                    order will not be actually deleted, but will be marked
                    as “disabled” and will no longer show up for
                    customers.</li>
                <li>Success messages will show after successful
                    addition, update, or deletion.</li>
                <li>Error messages will show after failed addition,
                    update, or deletion.</li>
                <li>A confirmation message will show upon attempting
                    deletion.</li>
                <li>Products can be added to subcategories.</li>
                <li>Products can be removed from subcategories.</li>
                <li>A product can be added to more than one
                    subcategory.</li>
                <li>A subcategory can have more than one product.</li>
                <li>A product cannot be added to the same subcategory
                    more than once.</li>
                <li>Success messages will show after successful
                    addition, or removal.</li>
                <li>Error messages will show after failed addition or
                    removal.</li>
                <li>Admin can search products br id or name.</li>
                <li>Admin can list products alerts</li>
            </ul>
            </p>
            <h4 id="scrollspyHeading3" class="text-primary border-start border-3 border-primary ps-2">Orders</h4>
            <p>
            <ul>
                <li>Orders can be seen in a list.</li>
                <li>The list will be paginated, and will show 6
                    orders per page.</li>
                <li>The list shows the following details for each order: Order ID, Customer name, Order creation date,
                    Number of items in order, Total order cost, Order status. </li>
                <li>The details will include: Order ID, Customer name, Order creation date,Items in order,Number of items in
                    order each with its price and quantity
                    and total, Total order cost and Order status. </li>
                <li>The allowed statuses are:Processing, Shipped, Delivered, Complete and Canceled.</li>
                <li>The staus action button will appear to admin depending on the order status.</li>
                <li>A success message will show after a successful
                    update.</li>
                <li>An error message will show after a failed update.</li>
                <li>A confirmation message will show if the admin
                    attempts to cancel an order.</li>
                <li>admin can search orders by id.</li>
            </ul>
            </p>
            <h4 id="scrollspyHeading4" class="text-primary border-start border-3 border-primary ps-2">Users</h4>
            <p>
            <ul>
                <li>Users can be seen in a list.</li>
                <li>The list will be paginated, and will show 6
                    orders per page.</li>
                <li>The list shows the following details for each user: ID, name, email, Number of all orders items and all
                    user alerts for products. </li>
                <li>Admin can block or active user status.</li>
                <li>Admin can search users by id or email.</li>
            </ul>
            </p>
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
