<nav class="navbar py-4 py-lg-3 bg-light">
    <div class="container-fluid">
        <div class="creat">
            <!-- product -->
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('users.blocked') }}" class="btn btn-primary my-2">
                    Blocked <span class="badge text-bg-danger">{{ getBlockedUsers()->count() }}</span>
                </a>
                <a href="{{ route('users.actived') }}" class="btn btn-primary my-2">
                    Actived <span class="badge text-bg-success">{{ getActivedUsers()->count() }}</span>
                </a>
            </div>
            <!-- end product -->
        </div>
        <div class="search">
            <form action="{{ route('users.search') }}" method="GET"
                class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                @csrf
                <input name="search" class="form-control " type="search" placeholder="User ID or email" required
                    value="{{ old('search') }}">
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
