<div class="modal fade" id="productsfilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5">Products Filter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($route) }}" method="GET" enctype="multipart/form-data">
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
                    <div class="form-check my-3">
                        <div class="form-check form-check-inline">
                            <input name="return" class="form-check-input" type="checkbox">
                            <label class="form-check-label">Return Policy</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="discount" class="form-check-input" type="checkbox">
                            <label class="form-check-label">Discount</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="view" class="form-check-input" type="checkbox">
                            <label class="form-check-label">Hot</label>
                        </div>
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
