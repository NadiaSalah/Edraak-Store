<div class='session'>

    <!--Session-->
    @if (Session::has('msg'))
        <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
            <span>{{ Session::get('msg') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <span>{{ Session::get('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @php
        session()->forget(['msg', 'error']);
    @endphp

    <!--Validation-->
    @if ($errors->any())
        <div class="alert alert-danger  fade show m-3" role="alert">
            <div class="text-end">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
