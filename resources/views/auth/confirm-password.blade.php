@extends('layouts.auth')
@section('page')
    <div class="alert alert-info fw-lighter mt-3 mb-4" role="alert">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-floating">
            <input class="form-control" id="floatingPassword" type="password" placeholder="Password" name="password" required
                autocomplete="current-password">
            <label for="floatingPassword">Password</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3 px-4">Confirm</button>
    </form>
@endsection
