
<div style="background-color:#011153;">
    <hr class="border border-primary border-3 opacity-75">
    <div class="container py-5">

        <div class="row g-3">
            <div class="col">
                <div class="text-center my-4">
                    <img src="{{ asset('assets/images/front/logo.png') }}" class="img-fluid" alt="logo"
                        style="max-width: 350px;">
                </div>
                <h4 class="text-info">About Us</h4>
                <p class="text-light fw-lighter">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus, turpis non aliquet pharetra,
                    tellus neque feugiat libero, vel dapibus est felis eget justo. Pellentesque tincidunt sit amet
                </p>
            </div>
            <div class="col">
                <div>
                    <h4 class="text-info">Contact Us</h4>
                    <ul class="list-unstyled text-light fs-6 fw-lighter">
                        <li><span class="pe-2 fs-5" style="color:#E14C2B;"><i class="fa-solid fa-headset"></i></span>
                            19123
                        </li>
                        <li><span class="pe-2 fs-5" style="color:#E14C2B;"><i
                                    class="fa-solid fa-square-phone"></i></span>
                            +22123456789</li>
                        <li><a href="#" style="text-decoration: none;" class="text-light">
                                <span class="pe-2 fs-5" style="color:#E14C2B;"><i
                                        class="fa-brands fa-square-facebook"></i></span> edraakstrore
                            </a></li>
                        <li><span class="pe-2 fs-5" style="color:#E14C2B;"><i
                                    class="fa-solid fa-location-dot"></i></span>
                            Egypt, Cairo, Naser City.</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <h4 class="text-info">Category</h4>
                    <ul class="list-inline">
                        @forelse (getMainCategories() as $m_item)
                            @if (count($m_item->products) != 0)
                                @forelse($m_item->subCategories as $s_item)
                                    <li class="list-inline-item rounded-pill fs-6 px-2 py-1 m-1"
                                        style="background-color:#E14C2B;">
                                        <a href="{{ route('ProductsFront.index', ['m_id' => $m_item->id, 's_id' => $s_item->id]) }}"
                                            style="text-decoration: none;color:#011153;">
                                            {{ $m_item->name }}/{{ $s_item->name }}</a>
                                    </li>
                                @empty
                                @endforelse
                            @endif
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
