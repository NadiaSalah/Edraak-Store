@extends('layouts.front')
@section('page')
    <div class="container mt-5">
        <nav id="navbar-example2" class="navbar bg-light px-3 mb-3">
            <a class="navbar-brand " href="{{ route('website') }}"><img class="" style="width:70px"
                    src="{{ asset('assets/images/front/logo-c.png') }}" alt="logo"></a>

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading1">First</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading2">Second</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Other</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#scrollspyHeading3">Third</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading4">Fourth</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#scrollspyHeading5">Fifth</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
            data-bs-smooth-scroll="true" class="scrollspy-example bg-light p-4 rounded-2" tabindex="0">
            <div class="text-center my-4">
                <img src="{{ asset('assets/images/front/logo-c.png') }}" class="img-fluid" alt="logo">
            </div>
            <h4 id="scrollspyHeading1" class="text-primary">First Policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra, tellus
                neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet sapien nec finibus.
                Aenean dignissim magna eu tellus mollis luctus. Quisque euismod commodo tempor. Pellentesque ipsum sem,
                mattis sit amet malesuada vitae, mollis ac purus. Morbi ut risus posuere, commodo sapien in, ultricies
                nulla. Donec sit amet rutrum neque. Praesent ultricies tristique augue, nec aliquet dui venenatis ac. Fusce
                interdum tristique mi vitae ultrices. Donec eleifend sit amet mi eu molestie. Fusce metus nulla, scelerisque
                sit amet felis id, maximus gravida nisl. Integer rhoncus faucibus varius. Suspendisse id placerat felis,
                lacinia efficitur eros. </p>
            <h4 id="scrollspyHeading2" class="text-primary">Second Policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra, tellus
                neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet sapien nec finibus.
                Aenean dignissim magna eu tellus mollis luctus. Quisque euismod commodo tempor. Pellentesque ipsum sem,
                mattis sit amet malesuada vitae, mollis ac purus. Morbi ut risus posuere, commodo sapien in, ultricies
                nulla. Donec sit amet rutrum neque. Praesent ultricies tristique augue, nec aliquet dui venenatis ac. Fusce
                interdum tristique mi vitae ultrices. Donec eleifend sit amet mi eu molestie. Fusce metus nulla, scelerisque
                sit amet felis id, maximus gravida nisl. Integer rhoncus faucibus varius. Suspendisse id placerat felis,
                lacinia efficitur eros. </p>
            <h4 id="scrollspyHeading3" class="text-primary">Third Policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra, tellus
                neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet sapien nec finibus.
                Aenean dignissim magna eu tellus mollis luctus. Quisque euismod commodo tempor. Pellentesque ipsum sem,
                mattis sit amet malesuada vitae, mollis ac purus. Morbi ut risus posuere, commodo sapien in, ultricies
                nulla. Donec sit amet rutrum neque. Praesent ultricies tristique augue, nec aliquet dui venenatis ac. Fusce
                interdum tristique mi vitae ultrices. Donec eleifend sit amet mi eu molestie. Fusce metus nulla, scelerisque
                sit amet felis id, maximus gravida nisl. Integer rhoncus faucibus varius. Suspendisse id placerat felis,
                lacinia efficitur eros. </p>
            <h4 id="scrollspyHeading4" class="text-primary">Fourth Policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra, tellus
                neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet sapien nec finibus.
                Aenean dignissim magna eu tellus mollis luctus. Quisque euismod commodo tempor. Pellentesque ipsum sem,
                mattis sit amet malesuada vitae, mollis ac purus. Morbi ut risus posuere, commodo sapien in, ultricies
                nulla. Donec sit amet rutrum neque. Praesent ultricies tristique augue, nec aliquet dui venenatis ac. Fusce
                interdum tristique mi vitae ultrices. Donec eleifend sit amet mi eu molestie. Fusce metus nulla, scelerisque
                sit amet felis id, maximus gravida nisl. Integer rhoncus faucibus varius. Suspendisse id placerat felis,
                lacinia efficitur eros. </p>
            <h4 id="scrollspyHeading5" class="text-primary">Fifth Policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra, tellus
                neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet sapien nec finibus.
                Aenean dignissim magna eu tellus mollis luctus. Quisque euismod commodo tempor. Pellentesque ipsum sem,
                mattis sit amet malesuada vitae, mollis ac purus. Morbi ut risus posuere, commodo sapien in, ultricies
                nulla. Donec sit amet rutrum neque. Praesent ultricies tristique augue, nec aliquet dui venenatis ac. Fusce
                interdum tristique mi vitae ultrices. Donec eleifend sit amet mi eu molestie. Fusce metus nulla, scelerisque
                sit amet felis id, maximus gravida nisl. Integer rhoncus faucibus varius. Suspendisse id placerat felis,
                lacinia efficitur eros. </p>
        </div>

    </div>
@endsection
