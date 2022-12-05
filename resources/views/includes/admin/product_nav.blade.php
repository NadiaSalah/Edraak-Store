<nav class="navbar py-4 py-lg-3 bg-light">
    <div class="container-fluid">
        <div class="creat">
            <!-- product -->
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('products.create') }}" class="btn btn-primary my-2 ">
                    Create Product
                </a>
                <a href="{{ route('productAlerts.index') }}" class="btn btn-primary my-2">
                    Alerts <span class="badge text-bg-danger">{{ getAlerts()->total() }}</span>
                </a>
            </div>
            <!-- end product -->
        </div>
        <div class="search">
            <form action="{{ route('products.search') }}" method="GET"
                class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                @csrf
                <input name="search" class="form-control " type="search" placeholder="Product ID or Name" required
                    value="{{ old('search') }}">
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
