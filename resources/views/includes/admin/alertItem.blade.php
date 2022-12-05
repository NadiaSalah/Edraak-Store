<div class="alert alert-danger  my-3" role="alert">
    <div class=" d-flex align-items-center">
        <div class="p-4"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <div>
            <h6 class="fw-bolder">
                id:# {{ $a_item->user_id }} /
                <i class="fa-solid fa-user"></i> {{ $a_item->user->first_name }} /
                <i class="fa-solid fa-at"></i> {{ $a_item->user->email }}
            </h6>
            <h6 class="fw-bolder"><a href="{{ route('products.show', $a_item->product_id) }}"
                    style="text-decoration: none;">
                    id:# {{ $a_item->product_id }} / <i class="fa-solid fa-store"></i> {{ $a_item->product->name }}
                </a>
            </h6>
            <hr class="border border-danger border-2 opacity-50">
            <p class="ps-2">
                {{ $a_item->alert }}
            </p>
        </div>
    </div>
    <div class="text-end p-3">
        <!-- Button trigger Delete alert modal-->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#delete_alertX{{ $a_item->id }}">
            <i class="fa-solid fa-trash"></i> Delete</button>
        <!--END Button-->
    </div>
</div>
<!-- Delete alert Modal -->
<div class="modal fade" id="delete_alertX{{ $a_item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Danger! Are you sure to deleteing the alert id# {{ $a_item->id }}
                </div>
            </div>
            <div class="modal-footer">
                <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                <form class="btn" action="{{ route('productAlerts.destroy', $a_item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Model -->
