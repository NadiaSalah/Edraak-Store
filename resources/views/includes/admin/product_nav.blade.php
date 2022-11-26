<nav class="navbar py-4 py-lg-3 bg-light">
    <div class="container-fluid">
        <div class="creat">
            <!-- product -->
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('products.create') }}" class="btn btn-primary ">
                    Create Product
                </a>

            </div>
            <!-- end product -->

        </div>
        <div class="search">
            <form action="{{ route('products.search') }}" method="GET"
                class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                @csrf
                <input name="search" class="form-control " type="search" placeholder="Product Name" required>
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
