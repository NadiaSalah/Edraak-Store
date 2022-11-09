@extends('layouts.auth')
@section('page')
    <h4 class="text-primary  fw-semibold my-3">Registration</h4>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group">
            <span class="input-group-text">First and last name</span>
            <input type="text" aria-label="First name" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First Name" required autofocus >
            <input type="text" aria-label="Last name" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" required autofocus>
        </div>
        <div class="input-group my-3">
            <input type="email" class="form-control" placeholder="Email address" aria-label="Email address"
                aria-describedby="basic-addon2" name="email" value="{{old('email')}}" required>
            <span class="input-group-text" id="basic-addon2">@example.com</span>
        </div>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Password</label>
            <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password"
            required autocomplete="new-password">
        </div>
        <div class="col-auto mt-3">
            <label for="inputPassword2" class="visually-hidden">Confirm Password</label>
            <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm Password" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3 px-3">Register</button>
        <a  href="{{ route('login') }}" class="btn btn-success mt-3 px-4">Login ></a>
    </form>
@endsection
