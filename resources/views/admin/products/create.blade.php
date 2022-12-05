@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-primary" href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">Create</li>
        </ol>
    </nav>
@endsection
<!--End title-->
<!--page-->
@section('page')
    <div class="card  shadow-sm mt-4 ">
        <div class="card-header bg-primary text-light">
            Enter Product Data
        </div>
        <div class="card-body mt-4 p-4">
            <div class="mb-3">
                <div class="m-auto" id="previewImg"
                    style=" max-width: 300px; height: 300px; background: url({{ asset('assets/images/front/Getimage.png') }})  no-repeat scroll center ; background-size: cover;">
                </div>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Product Name"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input name="image" class="form-control" type="file" id="inputImg" required>
                </div>
                @isset($category)
                    <div class="mb-3">
                        <label class="form-label">Main Category</label>
                        <select name="main_category" class="form-select" size="1" value="{{ $category['main_id'] }}"
                            required>
                            <option value="{{ $category['main_id'] }}" selected>{{ $category['main_name'] }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub Category</label>
                        <select name="sub_category" class="form-select" size="1" value="{{ $category['sub_id'] }}"
                            required>
                            <option value="{{ $category['sub_id'] }}" selected>{{ $category['sub_name'] }}</option>
                        </select>
                    </div>
                @else
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="mb-3">
                            <label class="form-label">Main Category</label>
                            <select name="main_category" class="form-select" size="3" value="{{ old('main_category') }}"
                                required>
                                @forelse (getMaincategories() as $m_item)
                                    <option class="main collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseX{{ $m_item->id }}" aria-expanded="false"
                                        aria-controls="flush-collapseX{{ $m_item->id }}" value="{{ $m_item->id }}">
                                        {{ $m_item->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        @forelse (getMaincategories() as $m_item)
                            <div id="flush-collapseX{{ $m_item->id }}" class=" mb-3 accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <label class="form-label">Sub Category for: {{ $m_item->name }}</label>
                                <div class="overflow-auto border p-2 rounded" style="height: 90px;">
                                    @forelse ($m_item->subCategories as $s_item)
                                        <div class="form-check form-check">
                                            <input class="sub form-check-input" type="radio" name="sub_category"
                                                value="{{ $s_item->id }}" required>
                                            <label class="form-check-label">{{ $s_item->name }}</label>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                @endisset
                <div class="mb-3">
                    <label class="form-label">Sizes</label>
                    <select name="size[]" class="form-select" size="3" multiple value="{{ old('size[]') }}">
                        @forelse (getSizes() as $item)
                            @if ($item->name != 'no')
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @empty
                        @endforelse
                    </select>
                    <div class="form-text">Press Ctrl for multiple/remove selestion or "optional".</div>
                </div>
                <div class="mb-3 row g-3">
                    <div class="col-12 col-sm">
                        <label class="form-label">Quantity</label>
                        <input name="quantity" type="number" min="0" class="form-control"
                            placeholder="Product Quantity" value="{{ old('quantity') }}" required>
                    </div>
                    <div class="col-12 col-sm">
                        <label class="form-label">Price</label>
                        <input name="price" type="number" min="1" step="0.01" class="form-control"
                            placeholder="Product Price" value="{{ old('price') }}" required>
                    </div>
                    <div class="col-12 col-sm">
                        <label class="form-label">Discount % </label>
                        <input name="discount" type="number" min="0" step="1" max="100"
                            class="form-control" placeholder="Product Discount" value="{{ old('discount') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check  form-check-inline">
                        <input name="return" class="form-check-input" type="checkbox" i value="{{ old('return') }}">
                        <label class="form-check-label"> Return & Exchange policy</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="view" class="form-check-input" type="checkbox" i value="{{ old('view') }}">
                        <label class="form-check-label">Hot View</label>
                    </div>
                </div>
                <div class="my-4">
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('active');
            $('#products_link').addClass('active');
            $('.main').click(function(e) {
                e.preventDefault();
                $('.sub').prop('checked', false);
            });
            $("#inputImg").change(function(e) {
                e.preventDefault();
                var file = $("#inputImg").get(0).files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $('#previewImg').css('background-image', 'url("' + reader.result + '")');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
