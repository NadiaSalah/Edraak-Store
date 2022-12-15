@extends('layouts.admin')
<!--title-->
@section('page_title')
    <nav>
        <ol class="breadcrumb">
            @isset($title)
                <li class="breadcrumb-item">
                    <a class="link-primary" href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="breadcrumb-item">{{ $title }}</li>
            @else
                <li class="breadcrumb-item">Users</li>
            @endisset
        </ol>
    </nav>
@endsection
<!--End title-->
@section('page')
    @include('includes.admin.user_nav')
    <div class="container mt-5 p-0">
        <div class="accordion">
            @forelse ($users as $u_item)
                <div class="accordion-item border-top border-info">
                    <h2 class="accordion-header">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseX{{ $u_item->id }}" aria-expanded="true"
                            aria-controls="#collapseX{{ $u_item->id }}">
                            <i class="fa-solid fa-user"></i><span class="ps-1"> id#{{ $u_item->id }}</span>-
                            <i class="fa-solid fa-at"></i><span class="ps-1">{{ $u_item->email }}</span>
                        </button>
                    </h2>
                    <div id="collapseX{{ $u_item->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="container row row-col-auto g-3">
                                <div class="col p-2">
                                    <p> <strong class="text-primary">First Name: </strong> {{ $u_item->first_name }}</p>
                                    <p> <strong class="text-primary">Last Name: </strong> {{ $u_item->last_name }}</p>
                                    <p> <strong class="text-primary">Email: </strong> {{ $u_item->email }}</p>
                                </div>
                                <div class="col p-2">
                                    <p> <strong class="text-primary">Orders Items: #</strong> {{ $u_item->orderDetails->count() }}
                                        @if($u_item->orderDetails->count() !=0)
                                        <a href="{{ route('orders.show', $u_item->id) }}"
                                            class="btn btn-sm btn-warning ms-2">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @endif
                                    </p>
                                    <p> <strong class="text-primary">Alerts: #</strong>
                                        {{ $u_item->productAlerts->count() }}</p>
                                </div>
                            </div>
                            <div class="contianer text-end my-2">
                                @if ($u_item->status)
                                    <span class="text-success mx-2"> <strong class="text-primary">Status:
                                        </strong>Active</span>
                                    <!-- Button trigger Block user modal-->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#block_userX{{ $u_item->id }}">
                                        <i class="fa-solid fa-ban"></i> Block</button>
                                    <!--END Button-->
                                @else
                                    <span class="text-danger  mx-2"> <strong class="text-primary">Status:
                                        </strong>Block</span>
                                    <!-- Button trigger active user modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#active_userX{{ $u_item->id }}">
                                        <i class="fa-solid fa-circle-check"></i></i> Active
                                    </button>
                                    <!-- End Button-->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- active user Modal -->
                <div class="modal fade" id="active_userX{{ $u_item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-success" role="alert">
                                    info! Are you sure to active the user
                                    "id#{{ $u_item->id }} - {{ $u_item->first_name }}"
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                <form class="btn" action="{{ route('users.active', $u_item->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Active</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <!-- Delete user Modal -->
                <div class="modal fade" id="block_userX{{ $u_item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert">
                                    Danger! Are you sure to deleteing the user
                                    "id#{{ $u_item->id }} - {{ $u_item->first_name }}"
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                <form class="btn" action="{{ route('users.block', $u_item->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Block</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Model -->
            @empty
                <p> Sorry, No users.</p>
            @endforelse
        </div>
    </div>
    <!--Pagination-->
    <div class="mt-5 d-flex justify-content-center">
        {!! $users->links() !!}
    </div>
    <!--End Pagination-->
    <!--page-->
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('activeLink');
            $('#users_link').addClass('activeLink');
        });
    </script>
@endsection
