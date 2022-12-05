@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">
                Categories
            </li>
            <li class="breadcrumb-item">
                <a class="link-primary" href="{{ route('mainCategories.index') }}">
                    Main >> </a>
            </li> 
                @isset($title)
                <li class="breadcrumb-item">
                    <a class="link-primary" href="{{ route('subCategories.index') }}">Sub >></a>
                </li>
                <li class="breadcrumb-item ">Search</li>
                @else
                <li class="breadcrumb-item ">Sub</li> 
                @endisset  
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    <!--Nav-->
    @include('includes.admin.category_nav')
    <!--End Nav-->
    <!--page-->
    <div class="items mt-5">
        <div class="accordion" id="accordionExample">
            <!-- subCategories-->
            @forelse ($sub_categories as $sub_item)
                <div class="accordion-item">
                    <div class="accordion-header accordion-button " id="headingX{{ $sub_item->id }}">
                        <div class="row w-100">
                            <h4 class='col-12 col-sm  align-self-start'>
                                <a href="{{route('subCategories.show', $sub_item->id)}}">{{ $sub_item->name }}</a>
                            </h4>
                            <div class="btn-group col-auto align-self-end" role="group">
                                <!-- Button trigger Delete subCategory modal-->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete_subCategoryX{{ $sub_item->id }}">
                                    <i class="fa-solid fa-trash"></i></button>
                                <!--END Button-->
                                <!-- Button trigger edit subCategory modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit_subCategoryX{{ $sub_item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i></button>
                                <!--END Button-->
                                <!-- Button collapse-->
                                <button type="button" class=" btn btn-primary " data-bs-toggle="collapse"
                                    data-bs-target="#collapseX{{ $sub_item->id }}" aria-expanded="false">
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                                <!--END Button-->
                            </div>
                        </div>
                    </div>
                    <!-- Delete mainCategory Modal -->
                    <div class="modal fade" id="delete_subCategoryX{{ $sub_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to deleteing the sub category "{{ $sub_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <form class="btn" action="{{ route('subCategories.destroy', $sub_item->id) }}"
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
                    <!-- Edit subCategory Modal -->
                    <div class="modal fade" id="edit_subCategoryX{{ $sub_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h1 class="modal-title fs-5">
                                        Edit sub Category:{{ $sub_item->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('subCategories.update', $sub_item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="my-3">
                                            <label class="form-label">sub
                                                Category Name</label>
                                            <input name="name" type="text" class="form-control" required
                                                value="{{ $sub_item->name }}">
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
                    <!--mainCategories-->
                    <div id="collapseX{{ $sub_item->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExampleX{{ $sub_item->id }}">
                        <div class="accordion-body">
                            <div class="container">
                                <div class="row ">
                                    <h5><span class="badge bg-info text-dark"> Main Categories:</span> </h5>
                                    @forelse ($sub_item->mainCategories as $main_item)
                                        <div class="col-auto m-2">
                                            <div class="  text-center py-1 px-3 border rounded-pill bg-light">
                                                {{ $main_item->name }} </div>
                                        </div>
                                    @empty
                                        <p>sorry, there are not main Categories</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END mainCategories-->
                </div>
                <!-- END subCategories-->
            @empty
                <p>sorry, there are not sub categories</p>
            @endforelse
        </div>
    </div>
    <!--Pagination-->
    <div class="mt-5 d-flex justify-content-center">
        {!! $sub_categories->links() !!}
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
