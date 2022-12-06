@extends('layouts.front')
<!--page-->
@section('page')
    @include('includes.front.user_header')
    <div class="container my-5 ">
        @forelse ($addresses as $Add_item)
            <div class="card border-success my-2">
                <div class="card-header bg-success bg-opacity-50 border-success fs-5">{{ $Add_item->name }}</div>
                <div class="card-body text-success">
                    <h5 class="card-title"><i class="fa-solid fa-square-phone"></i> {{ $Add_item->phone }}</h5>
                    <div class="card-text">
                        <div class=" row align-items-start g-2">
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-light bg-primary p-1 ">Add. line 1</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->address_line_1 }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-light bg-primary p-1">Add. line 2</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->address_line_2 }}</span>
                            </div>
                            <div class="col-auto rounded-pill">
                                <span class="rounded-start text-light bg-primary p-1">City</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->city }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-light bg-primary p-1">State</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->state }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-light bg-primary p-1">Country</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->country }}</span>
                            </div>
                            <div class="col-auto rounded-pill ">
                                <span class=" rounded-start text-light bg-primary p-1">Postal Code</span>
                                <span
                                    class="rounded-end bg-primary bg-opacity-25 text-dark p-1">{{ $Add_item->postal_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-success text-end">
                    <!-- Button trigger Delete address modal-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#delete_addressX{{ $Add_item->id }}">
                        <i class="fa-solid fa-trash"></i> Delete</button>
                    <!--END Button-->
                    <!-- Button trigger edit address modal -->
                    <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal"
                        data-bs-target="#edit_addressX{{ $Add_item->id }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <!-- End Button-->
                </div>
            </div>
            <!-- edit address Modal -->
            <div class="modal fade" id="edit_addressX{{ $Add_item->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-light">
                            <h1 class="modal-title fs-5">Edit Address</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('addresses.update', $Add_item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row g-3">
                                    <input name="userID" type="text" class="form-control" value={{ Auth::User()->id }}
                                        required hidden>
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" class="form-control"
                                            value="{{ $Add_item->name }}" required>
                                        <div class="form-text">for multiple adresses.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input name="phone" type="tel" class="form-control"
                                            value="{{ $Add_item->phone }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Address Line 1</label>
                                        <input name="address_line_1" type="text" class="form-control"
                                            placeholder="1234 Main St" value="{{ $Add_item->address_line_1 }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Address Line 2</label>
                                        <input name="address_line_2" type="text" class="form-control"
                                            placeholder="Apartment, studio, or floor"
                                            value="{{ $Add_item->address_line_2 }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <input name="city" type="text" class="form-control"
                                            value="{{ $Add_item->city }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">State</label>
                                        <input name="state" type="text" class="form-control"
                                            value={{ $Add_item->state }} required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">country</label>
                                        <input name="country" type="text" class="form-control"
                                            value="{{ $Add_item->country }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Postal Code</label>
                                        <input name="postal_code" type="text" class="form-control"
                                            value="{{ $Add_item->postal_code }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
            <!-- Delete address Modal -->
            <div class="modal fade" id="delete_addressX{{ $Add_item->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Danger! Are you sure to deleteing the Address "{{ $Add_item->name }}"
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                            <form class="btn" action="{{ route('addresses.destroy', $Add_item->id) }}"
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
        @empty
            <p>Sorry, No addresses for you </p>
            <a href="{{ route('users.profile') }}" class="link-success">Add Address "Profile"</a>
        @endforelse
        <!--Pagination-->
        <div class="mt-5 d-flex justify-content-center">
            {!! $addresses->links() !!}
        </div>
        <!--End Pagination-->
    </div>
@endsection
<!--ENDpage-->
