@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Categories</li>
            @isset($title)
            <li class="breadcrumb-item">
                <a class="link-primary" href="{{ route('mainCategories.index') }}">Main >></a>
            </li>
            <li class="breadcrumb-item ">Search</li>
            @else
            <li class="breadcrumb-item">Main</li>
            <li class="breadcrumb-item ">
                <a class=" link-primary" href="{{ route('subCategories.index') }}">
                    Sub >>
                </a>
            </li>
            @endisset  
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    <!--nave-->
    @include('includes.admin.category_nav')
    <!--End nave-->
    <!--page-->
    <div class="items mt-5">
        <div class="accordion" id="accordionExample">
            <!-- mainCategories-->
            @forelse ($main_categories as $main_item)
                <div class="accordion-item">
                    <div class="accordion-header accordion-button " id="headingX{{ $main_item->id }}">
                        <div class="row w-100">
                            <h4 class='col-12 col-sm  align-self-start'>{{ $main_item->name }}
                                <!-- Button trigger category image modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#img_mainCategoryX{{ $main_item->id }}">
                                    <i class="fa-regular fa-image"></i>
                                </button>
                                <!--END Button-->
                            </h4>
                            <div class="btn-group col-auto align-self-end" role="group">
                                <!-- Button trigger delet mainCategory modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete_mainCategoryX{{ $main_item->id }}">
                                    <i class="fa-solid fa-trash"></i></button>
                                <!--END Button-->
                                <!-- Button trigger Edit mainCategory modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit_mainCategoryX{{ $main_item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i></button>
                                <!--END Button-->
                                <!-- Button trigger create subCategory modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#create_subCategoryX{{ $main_item->id }}">
                                    <i class="fa-solid fa-plus"></i></button>
                                <!--END Button-->
                                <!-- Button collapse-->
                                <button type="button" class=" btn btn-primary " data-bs-toggle="collapse"
                                    data-bs-target="#collapseX{{ $main_item->id }}" aria-expanded="false">
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                                <!--END Button-->
                            </div>
                        </div>
                    </div>
                    <!-- mainCategory image Modal -->
                    <div class="modal fade" id="img_mainCategoryX{{ $main_item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h1 class="modal-title fs-5">
                                        image of {{ $main_item->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset($main_item->image) }}" class="img-fluid"
                                        alt="{{ $main_item->name }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal-->
                    <!-- create subCategory for mainCategory Modal-->
                    <div class="modal fade" id="create_subCategoryX{{ $main_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h1 class="modal-title fs-5">
                                        Create Sub Category For {{ $main_item->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('subCategories.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mt-3">
                                            <label class="form-label">Select Main Category</label>
                                            <select class="form-select" name="main" required>
                                                <option value="{{ $main_item->id }}">{{ $main_item->name }}</option>
                                            </select>
                                        </div>
                                        <div class="my-3">
                                            <label class="form-label">Sub Category Name</label>
                                            <input name="name" type="text" class="form-control" required
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                        <button type="submit" class="btn btn-primary">Store</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- Delete mainCategory Modal -->
                    <div class="modal fade" id="delete_mainCategoryX{{ $main_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to deleteing the main category "{{ $main_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <form class="btn" action="{{ route('mainCategories.destroy', $main_item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- Edit mainCategory Modal -->
                    <div class="modal fade" id="edit_mainCategoryX{{ $main_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h1 class="modal-title fs-5">
                                        Edit Main Category:{{ $main_item->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('mainCategories.update', $main_item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="my-3">
                                            <label class="form-label">Main
                                                Category Name</label>
                                            <input name="name" type="text" class="form-control" required
                                                value="{{ $main_item->name }}">
                                            <div class="my-3">
                                                <label class="form-label">Main
                                                    Category image</label>
                                                <input name="image" class="form-control" type="file"
                                                    value="{{ $main_item->image }}">
                                                <div class="form-text">not required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!--subCategories-->
                    <div id="collapseX{{ $main_item->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExampleX{{ $main_item->id }}">
                        <div class="accordion-body">
                            <div class="container">
                                <h5><span class="badge bg-info text-dark"> Sub Categories:</span> </h5>
                                <div class="row ">
                                    @forelse ($main_item->subCategories as $sub_item)
                                        <div class="col-auto m-2">
                                            <div class="  text-center py-2 px-3 border rounded-pill bg-light">
                                                <a
                                                    href="{{ route('categoryProducts.index', [
                                                        'm_id' => $main_item->id,
                                                        's_id' => $sub_item->id,
                                                    ]) }}">
                                                    {{ $sub_item->name }}</a>
                                                <div class="btn-group btn-group-sm ms-2" role="group">
                                                    <!-- Button trigger  delete subCategory modal -->
                                                    <button type="button" class="btn btn-outline-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete_subCategoryX{{ $main_item->id }}{{ $sub_item->id }}">
                                                        <i class="fa-solid fa-trash"></i></button>
                                                    <!--END Button-->
                                                    <!-- Button trigger  Edit subCategory modal -->
                                                    <button type="button" class="btn btn-outline-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#edit_subCategoryX{{ $main_item->id }}{{ $sub_item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i></button>
                                                    <!--END Button-->
                                                    <!-- Button create product -->
                                                    <a href="{{ route('categoryProducts.create', [
                                                        'm_id' => $main_item->id,
                                                        's_id' => $sub_item->id,
                                                    ]) }}"
                                                        class="btn btn-outline-dark">
                                                        <i class="fa-solid fa-plus"></i></a>
                                                    <!--END Button-->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete subCategory Modal -->
                                        <div class="modal fade"
                                            id="delete_subCategoryX{{ $main_item->id }}{{ $sub_item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger" role="alert">
                                                            Danger! Are you sure to deleteing the sub category
                                                            "{{ $sub_item->name }}" from main category
                                                            "{{ $main_item->name }}"
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</span>
                                                        <form class="btn"
                                                            action="{{ route('categories.destroy', ['s_id' => $sub_item->id, 'm_id' => $main_item->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Model -->
                                        <!-- Edit subCategory Modal -->
                                        <div class="modal fade"
                                            id="edit_subCategoryX{{ $main_item->id }}{{ $sub_item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h1 class="modal-title fs-5 ">
                                                            Update Sub Category : {{ $sub_item->name }} for <br />
                                                            Main Category : {{ $main_item->name }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('subCategories.update', $sub_item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mt-3">
                                                                <label class="form-label">Select Main
                                                                    Category</label>
                                                                <select class="form-select" name="main" required>
                                                                    <option value="{{ $main_item->id }}" selected>
                                                                        {{ $main_item->name }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="my-3">
                                                                <label class="form-label">Sub Category
                                                                    Name</label>
                                                                <input name="name" type="text" class="form-control"
                                                                    required value="{{ $sub_item->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</span>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Model -->
                                    @empty
                                        <p>sorry, there are not Sub Categories</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END subCategories-->
                </div>
                <!-- END mainCategories-->
            @empty
                <p>sorry, there are not main categories</p>
            @endforelse
        </div>
    </div>
    <!--Pagination-->
    <div class="mt-5 d-flex justify-content-center">
        {!! $main_categories->links() !!}
    </div>
    <!--End Pagination-->
    <!--page-->
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('active');
            $('#categories_link').addClass('active');
        });
    </script>
@endsection
