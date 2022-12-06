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
                                <li><a class="dropdown-item" href="{{ route('orderDetails.index') }}">Orders</a></li>
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
            <form class="d-flex   flex-column  flex-sm-row" action="{{ route('ProductsFront.search') }}"
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
            <!-- Modal -->
        </div>
    </div>
</nav>
<div class="modal fade" id="productsfilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5">Products Filter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ProductsFront.filter') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-check my-2">
                        <input name="categoryCheck" class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Category
                        </label>
                        <select class="form-select mt-2" name="category">
                            @forelse (getMainSubCategories() as $ms_item)
                                @if ($ms_item->products->count() > 0)
                                    <option value="{{ $ms_item->id }}">
                                        {{ $ms_item->maincategory->name }}/{{ $ms_item->subcategory->name }}
                                    </option>
                                @endif
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-check my-2">
                        <input name="priceCheck" class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Price <i class="fa-solid fa-dollar-sign"></i>
                        </label>
                        <div class="row">
                            <div class="input-group my-1 col-sm col-12">
                                <span class="input-group-text" id="basic-addon1">Min</span>
                                <input type="number" min='0' step="1" class="form-control"
                                    placeholder="Min" name="min" value="0">
                            </div>
                            <div class="input-group my-1 col-sm col-12">
                                <span class="input-group-text" id="basic-addon1">Max</span>
                                <input type="number" min='0' step="1" class="form-control"
                                    placeholder="Min" name="max" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-check my-2">
                        <input name="sizeCheck" class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            Size
                        </label>
                        <select class="form-select mt-2" name="size">
                            @forelse (getSizes() as $sz_item)
                                <option value="{{ $sz_item->id }}">
                                    @if ($sz_item->name != 'no')
                                        {{ $sz_item->name }}
                                    @else
                                        No Size
                                    @endif
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
