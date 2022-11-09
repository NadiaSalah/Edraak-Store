@extends('layouts.auth')
@section('page')
<h4 class="text-primary  fw-semibold my-3">Registration</h4>
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
    <div class="input-group my-3">
        <input type="email" class="form-control" placeholder="Email address" aria-label="Email address"
            aria-describedby="basic-addon2" name="email" value="{{old('email', $request->email)}}" required autofocus >
        <span class="input-group-text" id="basic-addon2">@example.com</span>
    </div>
    <div class="col-auto">
        <label for="inputPassword2" class="visually-hidden">Password</label>
        <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password" required >
    </div>
    <div class="col-auto mt-3">
        <label for="inputPassword2" class="visually-hidden">Confirm Password</label>
        <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm Password"  name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3 px-3">Reset Password</button>
</form>
@endsection
