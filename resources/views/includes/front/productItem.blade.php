<div class=" col-lg-4 col-md-6 col-12 p-1">
    <div class="card p-0">
        <div class="card-img-top position-relative"
            style="height: 250px; background: url({{ asset($p_item->image) }}) no-repeat scroll center ; background-size: cover;">
            @if ($p_item->discount != 0)
                <span class="badge position-absolute top-0 end-0 bg-danger fs-6  py-2">
                    <i class="fa-solid fa-arrow-down"></i> {{ $p_item->discount }} <i class="fa-solid fa-percent"></i>
                    <span class="visually-hidden">unread messages</span>
                </span>
            @endif
        </div>
        <div class="card-body" style="transform: rotate(0);">
            <h5 class="card-title text-primary">{{ substr($p_item->name, 0, 30) . '....' }}</h5>
            <p class="text-end m-0 p-0">
                @if ($p_item->discount == 0)
                    <span class="bg-info p-2 text-dark bg-opacity-25 rounded me-2 d-inline-block my-2">
                        <i class="fa-solid fa-dollar-sign"></i>{{ $p_item->price }}
                    </span>
                @else
                    <span class="bg-primary p-2 text-dark bg-opacity-25 rounded border border-info me-2 d-inline-block my-2">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="text-decoration-line-through text-danger">{{ $p_item->price }}</span>
                        <span>{{ $p_item->price * (1 - $p_item->discount / 100) }}</span>
                        <span class="text-success"></span>
                    </span>
                @endif
                    @if ($p_item->quantity == 0)
                        <span class="bg-danger p-2 text-danger bg-opacity-25 rounded d-inline-block my-2">
                            <i class="fa-solid fa-circle-xmark"></i> Out of stock
                        </span>
                    @else
                        <span class="bg-success p-2 text-success bg-opacity-25 rounded d-inline-block my-2">
                            <i class="fa-solid fa-cubes"></i> In stock: #{{ $p_item->quantity }}
                        </span>
                    @endif
                <!-- Button show product -->
                <a href="{{ route('productsFront.show', $p_item->id) }}" class="btn btn-warning stretched-link">
                    <i class="fa-sharp fa-solid fa-eye"></i></a>
                <!--END Button-->
            </p>
        </div>
        <div class="container my-2">
            @if ($p_item->quantity != 0)
                @isset($size)
                    <form action="{{ route('carts.update', $c_item) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <input name="productID" value="{{ $p_item->id }}" hidden required>
                            <input name="quantity" type="number" min="1" step="1" max={{ $p_item->quantity }}
                                class="form-control" placeholder="Product Numbers" value="{{ $c_item->quantity }}"
                                required>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa-solid fa-cart-plus"></i>
                                Update cart
                            </button>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="sizeID" required>
                                <option value="{{ $size->id }}" selected>
                                    @if ($size->name == 'no')
                                        No size
                                    @else
                                        {{ $size->name }}
                                    @endif
                                </option>
                            </select>
                        </div>
                    </form>
                @else
                    <form action="{{ route('carts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="productID" value="{{ $p_item->id }}" hidden required>
                            <input name="quantity" type="number" min="1" step="1" max={{ $p_item->quantity }}
                                class="form-control" placeholder="Product Numbers">
                            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-cart-plus"></i>
                                Add to cart </button>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="sizeID" required>
                                @forelse ($p_item->sizes as $item)
                                    @php $size_test = $item->name == 'no' ? true : false ; @endphp
                                    <option value="{{ $item->id }}" @selected($size_test)>
                                        @if ($size_test)
                                            No Sizes
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </option>
                                    @break($size_test)
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </form>
                @endisset
            @else
                <div class="bg-danger p-2 text-danger bg-opacity-25 rounded mb-3">
                    <i class="fa-solid fa-circle-xmark"></i> Out of stock
                </div>
            @endif
        </div>
        @isset($size)
            <div class=" container mb-3 rounded-bottom">
                <span class=" p-2 text-bg-warning d-inline-block my-2 rounded">id#{{ $c_item->id }}</span>
                <span class=" p-2 text-bg-primary d-inline-block my-2 rounded"># {{ $c_item->quantity }}</span>
                <span class=" p-2 text-bg-success d-inline-block my-2 rounded">
                    $ {{ $c_item->quantity * $p_item->price * (1 - $p_item->discount / 100) }}</span>
                <div class="text-end">
                    <!-- Button trigger Delete cart modal-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#delete_cartX{{ $c_item->id }}">
                        <i class="fa-solid fa-trash"></i> Delete</button>
                    <!--END Button-->
                </div>
            </div>
        @endisset
    </div>
</div>
