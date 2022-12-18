@if (count($premium_products = getPremiumProducts()) != 0)
    <div
        style="height: 250px; background: url({{ asset('assets/images/front/premium.jpg') }}) no-repeat fixed center ; background-size: cover;">
        <div class="d-flex  bg-dark bg-opacity-75 h-100 align-items-center ps-5">
            <span class="text-light border-start border-3 border-info ps-3 fs-1"> PREMIUM </span> 
            <p class="text-light ms-3">Offers & Return Policy</p>         
        </div>    
    </div>
    <div class="container my-5">
        <div class=" row my-5">
            @forelse ($premium_products as $p_item)
            @include('includes.front.productItem')
            @empty
                <p>Sorry, there are not Products</p>
            @endforelse
            <!--Pagination-->
            <div class="mt-5 d-flex justify-content-center">
                {!! $premium_products->links() !!}
            </div>
            <!--End Pagination-->

        </div>
    </div>
@endif
