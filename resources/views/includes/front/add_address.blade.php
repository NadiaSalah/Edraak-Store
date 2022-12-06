<!-- add address Modal -->
<div class="modal fade" id="addAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Address</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <input name="userID" type="text" class="form-control" value="{{ $user->id }}" required
                            hidden>
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                                required>
                            <div class="form-text">for multiple adresses.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input name="phone" type="tel" class="form-control" value="{{ old('phone') }}"
                                required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address Line 1</label>
                            <input name="address_line_1" type="text" class="form-control" placeholder="1234 Main St"
                                value="{{ old('address_line_1') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address Line 2</label>
                            <input name="address_line_2" type="text" class="form-control"
                                placeholder="Apartment, studio, or floor" value="{{ old('address_line_2') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input name="city" type="text" class="form-control" value="{{ old('city') }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <input name="state" type="text" class="form-control" value="{{ old('state') }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">country</label>
                            <input name="country" type="text" class="form-control" value="{{ old('country') }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Postal Code</label>
                            <input name="postal_code" type="text" class="form-control"
                                value="{{ old('postal_code') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Store</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->
