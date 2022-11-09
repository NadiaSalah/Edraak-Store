@extends('layouts.auth')
@section('page')
    <div class="alert alert-info mt-3 mb-4" role="alert">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
        we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>


    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mt-3 mb-4" role="alert">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif


    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-3 px-4">Resend Verification Email</button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-3 px-4">Logout</button>
    </form>
@endsection
