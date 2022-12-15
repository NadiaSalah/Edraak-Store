@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">
                Archive Categories
            </li>
            <li class="breadcrumb-item ">
                <span class="badge text-bg-warning position-relative">Main
                    @if ($main_categories != null)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $main_categories->count() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif
                </span>
            </li>
            <li class="breadcrumb-item  mt-2 mt-sm-0">
                <a class=" link-primary" href="{{ route('subCategories.archive') }}">
                    Sub >>
                </a>
            </li>
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    @if ($main_categories != null && $main_categories->count() > 0)
        <!--Nav-->
        <nav class="navbar bg-light p-3">
            <div class="container-fluid  justify-content-start justify-content-md-end">
                <!-- Button trigger forceDeleteAll mainCategory modal-->
                <button type="button" class="btn btn-outline-success m-2 m-sm-1" data-bs-toggle="modal"
                    data-bs-target="#restoreAll_mainCategoryX">
                    Restore All</button>
                <!--END Button-->
                <!-- Button trigger restore All mainCategory modal -->
                <button type="button" class="btn btn-outline-danger m-2 m-sm-1" data-bs-toggle="modal"
                    data-bs-target="#forceDeleteAll_mainCategoryX">
                    Force Delete All</button>
                <!--END Button-->
            </div>
        </nav>
    @endif
    <!--End Nav-->
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
                                <!-- Button trigger forceDelete mainCategory modal-->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#forceDelete_mainCategoryX{{ $main_item->id }}">
                                    <i class="fa-solid fa-trash"></i></button>
                                <!--END Button-->
                                <!-- Button trigger restore mainCategory modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#restore_mainCategoryX{{ $main_item->id }}">
                                    <i class="fa-solid fa-trash-arrow-up"></i></button>
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
                                <div class="modal-header">
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
                    <!-- restoreAll mainCategory Modal -->
                    <div class="modal fade" id="restoreAll_mainCategoryX" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-warning" role="alert">
                                        warning! Are you sure to restoreing all main categories from archive
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('mainCategories.restoreAll') }}" class="btn btn-primary">Restore All
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- forceDeleteAll mainCategory Modal -->
                    <div class="modal fade" id="forceDeleteAll_mainCategoryX" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to force deleteing all main categories from archive
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('mainCategories.forceDeleteAll') }}" class="btn btn-primary">Force
                                        Delete All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!--subCategories-->
                    <!-- restore mainCategory Modal -->
                    <div class="modal fade" id="restore_mainCategoryX{{ $main_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-warning" role="alert">
                                        warning! Are you sure to restoreing the main category "{{ $main_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('mainCategories.restore', $main_item->id) }}"
                                        class="btn btn-primary">Restore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!-- forceDelete mainCategory Modal -->
                    <div class="modal fade" id="forceDelete_mainCategoryX{{ $main_item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Danger! Are you sure to force deleteing the main category "{{ $main_item->name }}"
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <a href="{{ route('mainCategories.forceDelete', $main_item->id) }}"
                                        class="btn btn-primary">Force Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Model -->
                    <!--subCategories-->
                    <div id="collapseX{{ $main_item->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExampleX{{ $main_item->id }}">
                        <div class="accordion-body">
                            <div class="container">
                                <div class="row ">
                                    @forelse ($main_item->subCategories as $sub_item)
                                        <div class="col-auto m-2">
                                            <div class="  text-center py-1 px-3 border rounded-pill bg-light">
                                                {{ $sub_item->name }} </div>
                                        </div>
                                    @empty
                                        <p>sorry, there are not Subcategories</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END subCategories-->
                </div>
                <!-- END mainCategories-->
            @empty
                <p>sorry, there are not main categories in the archive</p>
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
            $('a.link').removeClass('activeLink');
            $('#categories_link').addClass('activeLink');
        });
    </script>
@endsection
