<nav class="navbar navbar-expand-lg  py-2 px-3 shadow-lg fixed-top bg-light mb-3">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{ route('website') }}"><img class="" style="width:70px"
                src="{{ asset('assets/images/front/logo-c.png') }}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  p-4 p-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('website') }}">Home</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('policy') }}">Policy</a></li>
                @auth
                    @if (Auth::User()->role == 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::User()->first_name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form class="dropdown-item p-0" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::User()->first_name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('users.profile') }}">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="d-flex justify-content-between align-items-start"><a class="dropdown-item" href="{{ route('orderDetails.index') }}">Orders</a>
                                    <span class="badge bg-danger rounded-pill me-3">
                                        {{ Auth::User()->orderDetails->where('status','processing')->count()}}
                                    </span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form class="dropdown-item p-0" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="nav-link">
                                <span class=" btn position-relative text-success">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    @if ($cart = count(Auth::User()->carts) > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count(Auth::User()->carts) }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-success" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            login/Registe
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}" class="dropdown-item">login</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="{{ route('register') }}" class="dropdown-item">register</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
            <form class="d-flex   flex-column  flex-sm-row" action="{{ route('productsFront.search') }}"
                method="GET">
                @csrf
                <input name='search' class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-outline-primary mt-2 mt-sm-0" type="submit">Search</button>
            </form>
            <!-- Button trigger products filter modal -->
            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#productsfilter">
                <i class="fa-solid fa-filter"></i>
            </button>
            <!-- End Button trigger-->
            <button class="btn btn-warning m-1"  type="button" data-bs-toggle="offcanvas" data-bs-target="#frontAside">
                <i class="fa-solid fa-tags"></i>
            </button>
        </div>
    </div>
</nav>
<!-- filter Modal -->
@include('includes.front.products_filter',['route'=>'productsFront.filter'])
<!-- End Modal -->
<!-- Aside -->
@include('includes.front.aside')
<!-- End Aside -->


