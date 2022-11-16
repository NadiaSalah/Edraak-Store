@extends('layouts.auth')
@section('page') 
<div class="alert alert-info fw-lighter mt-3 mb-4" role="alert">
    Forgot your password? No problem. Just let us know your email address and we will email you a password
    reset link that will allow you to choose a new one.
</div>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="input-group mb-2">
        <input type="email" class="form-control" placeholder="Email Address" aria-label="Email"
            aria-describedby="basic-addon2"
            name="email" 
            value="{{old('email')}}" 
            required autofocus>
        <span class="input-group-text" id="basic-addon2">@example.com</span>
    </div>
    <button type="submit" class="btn btn-primary mt-3 px-4">Email Password Reset Link</button>
    <a href="{{route('login')}}" class="btn btn-success mt-3 px-4">Login ></a>
</form>
@endsection
