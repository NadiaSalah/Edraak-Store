<ul class="list-group col">
    @isset($status)
        <li class="list-group-item list-group-item-info">
            Order id#{{ $od_item->order->id }} <br>
            <span class=" d-inline-block  m-1"><strong class="text-primary">
                    <i class="fa-solid fa-calendar-plus"></i> Created at: </strong>
                <i class="fa-solid fa-hashtag"></i>
                {{ $od_item->order->created_at }}</span>
        </li>
        <li class="list-group-item list-group-item-primary">
            <div class="rounded">
                <h6 class="text-primary m-1">
                    <i class="fa-solid fa-truck-fast"></i> Shiping Details</h6>
                @php
                    $a_item = $od_item->order->address;
                @endphp
                <p class="mx-3">
                        <i class="fa-solid fa-user"></i> {{ $od_item->order->user->first_name }}
                        {{ $od_item->order->user->last_name }} /
                        <i class="fa-solid fa-phone"></i> {{ $a_item->phone }} /
                        <i class="fa-solid fa-location-dot"></i>
                    {{ $a_item->address_line_2 }},
                    {{ $a_item->address_line_2 }}. {{ $a_item->city }}, {{ $a_item->state }},
                    {{ $a_item->country }} and {{ $a_item->postal_code }}
                </p>
            </div>
        </li>
    @endisset
    <li class="list-group-item text-bg-info">
        Order Item id#{{ $od_item->id }}
    </li>
    <li class="list-group-item list-group-item-info">
        Item : {{ $od_item->productSize->product->name }}
    </li>
    <li class="list-group-item list-group-item-secondary">
        Size :
        @if ($od_item->productSize->size->name == 'no')
            No Size
        @else
            {{ $od_item->productSize->size->name }}
        @endif
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Item Price
        <span class="badge bg-danger rounded-pill fs-6">
            <i class="fa-solid fa-dollar-sign"></i> {{ $od_item->price }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Total Quantity
        <span class="badge bg-danger rounded-pill fs-6">
            <i class="fa-solid fa-hashtag"></i> {{ $od_item->quantity }}</span>
    </li>
    <li class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center">
        Total Price
        <span class="badge bg-danger rounded-pill fs-6">
            <i class="fa-solid fa-dollar-sign"></i> {{ $od_item->total_price }}</span>
    </li>
    @php
        $class = orderStatusCalss($od_item->status);
    @endphp
    <li class="list-group-item list-group-item-{{ $class }}">
        Status : {{ $od_item->status }}
    </li>
</ul>
