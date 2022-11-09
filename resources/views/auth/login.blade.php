@extends('layouts.auth')
@section('page')
    <h4 class="text-primary  fw-semibold my-3">Login into account</h4>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
                value="{{old('email')}}" required autofocus>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                required autocomplete="current-password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="mt-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1 name="remember"">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3 px-4">login</button>
        <a href="{{route('register')}}" class="btn btn-success mt-3 px-3">Registration ></a>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="d-block link-danger mt-2">Forgot your password?
            </a>
        @endif

    </form>
@endsection
