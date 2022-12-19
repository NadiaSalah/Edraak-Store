@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-primary" href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item text-capitalize">Archive</li>
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    @if ($products != null && $products->count() > 0)
        <!--Nav-->
        <nav class="navbar bg-light p-3">
            <div class="container-fluid  justify-content-start justify-content-md-end">
                <!-- Button trigger forceDeleteAll product modal-->
                <button type="button" class="btn btn-outline-success m-2 m-sm-1" data-bs-toggle="modal"
                    data-bs-target="#restoreAll_productX">
                    Restore All</button>
                <!--END Button-->
            </div>
        </nav>
        <!-- restoreAll product Modal -->
        <div class="modal fade" id="restoreAll_productX" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            warning! Are you sure to restoreing all products from archive
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                        <a href="{{ route('products.restoreAll') }}" class="btn btn-primary">Restore All
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Model -->
    @endif
    <!--End Nav-->
    <!--page-->
    <div class="items mt-5">
        <div class=" row">
        @forelse ($products as $p_item)
        @include('includes.admin.productItem') 
        @empty
            <p>sorry, there are not products in the archive</p>
        @endforelse
        </div>
    </div>
    </div>
    <!--Pagination-->
    <div class="mt-5 d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
    <!--End Pagination-->
    <!--page-->
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('activeLink');
            $('#products_link').addClass('activeLink');
        });
    </script>
@endsection
