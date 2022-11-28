@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">
                Archive Categories
            </li>
            <li class="breadcrumb-item ">
                <a class=" link-primary" href="{{ route('categories.archive') }}">
                    Main >>
                </a>
            </li>
            <li class="breadcrumb-item mt-3 mt-sm-0">

                <span class=" badge text-bg-warning position-relative">sub
                    @if ($sub_categories != null)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $sub_categories->count() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif
                </span>
            </li>

        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    @if ($sub_categories != null && $sub_categories->count() > 0)
        <!--Nav-->
        <nav class="navbar bg-light p-3">
            <div class="container-fluid  justify-content-start justify-content-md-end">
                <!-- Button trigger forceDeleteAll subCategory modal-->
                <button type="button" class="btn btn-outline-success m-2 m-sm-1" data-bs-toggle="modal"
                    data-bs-target="#restoreAll_subCategoryX">
                    Restore All</button>
                <!--END Button-->
                <!-- Button trigger restore All subCategory modal -->
                <button type="button" class="btn btn-outline-danger m-2 m-sm-1" data-bs-toggle="modal"
                    data-bs-target="#forceDeleteAll_subCategoryX">
                    Force Delete All</button>
                <!--END Button-->
            </div>
        </nav>
    @endif
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
                                {{ $sub_item->name }}
                            </h4>
                            <div class="btn-group col-auto align-self-end" role="group">
                                <!-- Button trigger forceDelete subCategory modal-->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#forceDelete_subCategoryX{{ $sub_item->id }}">
                                    <i class="fa-solid fa-trash"></i></button>
                                <!--END Button-->
                                <!-- Button trigger restore subCategory modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#restore_subCategoryX{{ $sub_item->id }}">
                                    <i class="fa-solid fa-trash-arrow-up"></i></button>
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
                    <!-- restoreAll subCategory Modal -->
                    <div class="modal fade" id="restoreAll_subCategoryX" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-warning" role="alert">
                                        warning! Are you sure to restoreing all sub categories from archive
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('subCategories.restoreAll') }}" class="btn btn-primary">Restore All
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- forceDeleteAll subCategory Modal -->
                    <div class="modal fade" id="forceDeleteAll_subCategoryX" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to force deleteing all sub categories from archive
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('subCategories.forceDeleteAll') }}" class="btn btn-primary">Force
                                        Delete All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->

                    <!-- restore subCategory Modal -->
                    <div class="modal fade" id="restore_subCategoryX{{ $sub_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-warning" role="alert">
                                        warning! Are you sure to restoreing the sub category "{{ $sub_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('subCategories.restore', $sub_item->id) }}"
                                        class="btn btn-primary">Restore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- forceDelete subCategory Modal -->
                    <div class="modal fade" id="forceDelete_subCategoryX{{ $sub_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to force deleteing the sub category "{{ $sub_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('subCategories.forceDelete', $sub_item->id) }}"
                                        class="btn btn-primary">Force Delete</a>
                                </div>
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
                    <!--END subCategories-->
                </div>
                <!-- END mainCategories-->
            @empty
                <p>sorry, there are not sub categories in the archive</p>
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
