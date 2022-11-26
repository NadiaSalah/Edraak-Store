@extends('layouts.admin')
<!--title-->
@section('page_title', 'Welcome Admin')
<!--End title-->
<!--page-->
@section('page')
    <h1> Hello admin</h1>
@endsection
<!--ENDpage-->
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('a.link').removeClass('active');
            $('#dashboard_link').addClass('active');
        });
    </script>

@endsection
