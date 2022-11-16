
<div class="admin_header shadow p-3  mb-3 bg-light hstack gap-3">
    <span class="btn btn-outline-primary" id="menu-btn">
        <i class="fa-solid fa-bars"></i>
    </span>
    <img src="{{asset('assets/images/front/logo-c.png')}}" class="header_logo" alt="logo">
    <form class="ms-auto" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger ">Logout</button>
    </form>
    <div class="vr"></div>
    @auth()
        <span class="name text-primary mx-2 fs-5">{{Auth::User()->first_name}}</span>
    @endauth

</div>

