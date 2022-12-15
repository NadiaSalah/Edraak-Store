<nav class="navbar py-4 py-lg-3 bg-light">
    <div class="container-fluid">
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Status Filter
            </button>
            <ul class="dropdown-menu">
                @forelse (allOrderStatus() as $os_item)
                    <li><a class="dropdown-item text-capitalize"
                            href="{{ route('orders.show', $os_item) }}">{{ $os_item }}</a></li>
                @empty
                @endforelse
            </ul>
        </div>
        <div class="search">
            <form action="{{ route('orders.search') }}" method="GET"
                class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                @csrf
                <input name="search" class="form-control " type="search" placeholder="Order Item ID" required
                    value="{{ old('search') }}">
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit">Search</button>
            </form>
        </div>
</nav>
