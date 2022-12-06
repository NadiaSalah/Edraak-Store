<div class="container my-5">
  <div class="bg-info bg-opacity-25 my-5 py-3 px-3 text-dark border-start border-3 border-primary">
      <h6><span class="text-primary">user name: </span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}
      </h6>
      <h6><span class="text-primary">user email: </span>{{Auth::User()->email }}</h6>
      <a href="{{ route('users.profile') }}" class="link-success">Goto Profile >></a>
  </div>
</div>
