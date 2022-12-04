<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  @include('includes.meta')
  @include('includes.style')
  @yield('style')
</head>
<body>
  @yield('content')
  @include('includes.script')
  @include('includes.copyright')
  @yield('script')
</body>
</html>
