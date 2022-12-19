<div class="aside aside_min text-light">
    <div class="">
        <div class="logo text-center my-4 pt-3">
            <img class="aside_logo" src="{{ asset('assets/images/front/logo.png') }}" alt="logo">
            <img src="{{ asset('assets/images/front/logo-icon.png') }}" class="aside_icon" alt="logo">
        </div>
        <div class="links px-0">
            <ul class="ps-1">
                <li class="mt-1">
                    <a class="link fs-5 fw-semibold px-3 py-2 d-block" id="dashboard_link">
                        <span class="icon"><i class="fa-solid fa-sliders"></i></span>
                        <span class="title px-2" data-bs-toggle="collapse" href="#dashboard" role="button"
                            aria-expanded="false">
                            Dashboard <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </a>
                    <ul class="collapse px-5" id="dashboard">
                        <li><a class="dropdown-item py-2" href="{{ route('admin.welcome') }}">Welcome</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('dashboard.reports') }}">Reports</a></li>
                    </ul>
                </li>
                <li class="mt-1">
                    <a class="link fs-5 fw-semibold px-3 py-2 d-block" id="categories_link">
                        <span class="icon"><i class="fa-solid fa-tags"></i></span>
                        <span class="title px-2" data-bs-toggle="collapse" href="#categories" role="button"
                            aria-expanded="false">
                            Categories <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </a>
                    <ul class="collapse px-5" id="categories">
                        <li><a class="dropdown-item py-2" href="{{ route('mainCategories.index') }}">Mangement</a></li>
                    </ul>
                </li>
                <li class="mt-1">
                    <a class="link fs-5 fw-semibold px-3 py-2 d-block" id="products_link">
                        <span class="icon"><i class="fa-solid fa-store"></i></span>
                        <span class="title px-2" data-bs-toggle="collapse" href="#products" role="button"
                            aria-expanded="false">
                            Products <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </a>
                    <ul class="collapse px-5" id="products">
                        <li><a class="dropdown-item py-2" href="{{ route('products.index') }}">Mangement</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('products.archive') }}">Archive</a></li>
                    </ul>
                </li>
                <li class="mt-1">
                    <a class="link fs-5 fw-semibold px-3 py-2 d-block" id="orders_link">
                        <span class="icon"><i class="fa-solid fa-bag-shopping"></i></span>
                        <span class="title px-2" data-bs-toggle="collapse" href="#orders" role="button"
                            aria-expanded="false">
                            Orders <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </a>
                    <ul class="collapse px-5" id="orders">
                        <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}">Mangement</a></li>
                    </ul>
                </li>
                <li class="mt-1">
                    <a class="link fs-5 fw-semibold px-3 py-2 d-block" id="users_link">
                        <span class="icon"><i class="fa-solid fa-user-group"></i></span>
                        <span class="title px-2" data-bs-toggle="collapse" href="#users" role="button"
                            aria-expanded="false">
                            Users <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </a>
                    <ul class="collapse px-5" id="users">
                        <li><a class="dropdown-item py-2" href="{{ route('users.index') }}">Mangement</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
