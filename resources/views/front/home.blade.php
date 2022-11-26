@extends('layouts.front')
@section('page')
    <div class="container">
        <h1 class="mt-4"> welcome Home</h1>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3 px-4">Logout</button>
                </form>
                <h2> Name: {{ Auth::User()->first_name }}</h2>
            @else
                <a href="{{ route('login') }}" class="btn btn-info mt-3 px-3">login</a>
                <a href="{{ route('register') }}" class="btn btn-success mt-3 px-3">register</a>
            @endauth
      
    </div>
@endsection
