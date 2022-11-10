@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>admin : {{ Auth::user()->first_name }}</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-primary mt-3 px-4">Logout</button>
        </form>
    </div>
@endsection
