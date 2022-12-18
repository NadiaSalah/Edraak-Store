<div class="card my-3">
    @php
        $class = orderStatusCalss($od_item->status);
    @endphp
    <div class="card-header text-bg-{{ $class }}">
        <i class="fa-solid fa-bag-shopping"></i>
        Order id# {{ $od_item->order->id }} / Item id# {{ $od_item->id }}
        <span class="d-inline-block m-1 rounded text-capitalize">
            .... {{ $od_item->status }}
        </span>
    </div>
    <div class="card-body mb-3">
        <h6 class="card-title">
            <span class="text-primary">Item : </span> 
            <a href="{{route('productsFront.show', $od_item->product->id)}}" class="link-dark">
                {{ $od_item->product->name }} 
                <button type="button" class="btn btn-warning m-1 btn-sm">
                    <i class="fa-solid fa-eye"></i></button>
            </a>
            <span class="d-inline-block m-1 p-1 bg-primary bg-opacity-25 rounded">
                Size :
                @if ($od_item->size == 'no')
                    No Size
                @else
                    {{ $od_item->size }}
                @endif
            </span>
        </h6>
        <p class="card-text">
            @isset($index)
            <div>
                <h6 class="text-primary m-1">
                    <i class="fa-solid fa-truck-fast"></i> Shiping Details
                </h6>
                @php
                    $a_item = $od_item->order->address;
                @endphp
                <p class="mx-3">
                    <span class="text-success">
                        <i class="fa-solid fa-user"></i> {{ $od_item->order->user->first_name }}
                        {{ $od_item->order->user->last_name }}</span> /
                    <i class="fa-solid fa-phone"></i> {{ $a_item->phone }} /
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $a_item->address_line_2 }},
                    {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                    {{ $a_item->country }} and {{ $a_item->postal_code }}
                </p>
            </div>
        @endisset

        <div class=" text-primary">
            <h6 class="rounded d-inline-block m-1">
                Total Quantity
                <span class="badge bg-danger rounded-pill fs-6">
                    <i class="fa-solid fa-hashtag"></i> {{ $od_item->quantity }}</span>
            </h6>
            <h6 class="rounded d-inline-block m-1">
                Total Price
                <span class="badge bg-danger rounded-pill fs-6">
                    <i class="fa-solid fa-dollar-sign"></i> {{ $od_item->total_price }}</span>
            </h6>
        </div>
        </p>
        <div class="text-end">
            <div class="btn-group  btn-group-sm" role="group">
                @php
                    $action = orderAction($od_item->status);
                    $class = orderStatusCalss($action);
                @endphp
                @if ($od_item->status != 'canceled')
                    @if ($action != null)
                        <!-- Button update status trigger modal -->
                        <button type="button" class="btn btn-{{ $class }} text-capitalize"
                            data-bs-toggle="modal" data-bs-target="#updateStatusX{{ $od_item->id }}">
                            {{ $action }}</button>
                        <!--end Button-->
                    @endif
                    <!-- Button cancel status trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#cancelStatusX{{ $od_item->id }}">
                        <i class="fa-solid fa-rectangle-xmark"></i> Cancel</button>
                    <!--end Button-->
                @endif
                @isset($index)
                    <a href="{{ route('orders.edit', $od_item->id) }}" class="btn btn-success">
                        <i class="fa-solid fa-eye"></i> Show</a>
                @endisset
            </div>
        </div>
    </div>
</div>
<!-- update status Modal -->
<div class="modal fade" id="updateStatusX{{ $od_item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('orders.update', $od_item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" name="status" value="{{ $action }}" hidden required>
                    <div class="alert alert-{{ $class }}" role="alert">
                        Are You Sure to changing the order id# {{ $od_item->order->id }} / item id#
                        {{ $od_item->id }} status from {{ $od_item->status }} to
                        {{ $action }}.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal -->
<!-- canceled status Modal -->
<div class="modal fade" id="cancelStatusX{{ $od_item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('orders.update', $od_item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" name="status" value="canceled" hidden required>
                    <div class="alert alert-danger" role="alert">
                        Danger, Are You Sure to changing the order id# {{ $od_item->order->id }} / item id#
                        {{ $od_item->id }} status from {{ $od_item->status }} to
                        Cancel.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal -->
