
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="frontAside">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @forelse (getMainCategories() as $m_item)
            <ul class="list-group mt-3">
                <li class="list-group-item active" aria-current="true">{{ $m_item->name }}</li>
                @forelse ($m_item->subCategories as $s_item)
                    <li class="list-group-item"><a href="{{ route('productsFront.index',['m_id'=>$m_item->id,'s_id'=>$s_item->id]) }}" style="text-decoration: none;">{{ $s_item->name }}</a>
                    </li>
                @empty
                <li>sorry, there are not Subcategories</li>
                @endforelse
            </ul>
        @empty
        <p>sorry, there are not Main categories</p>
        @endforelse
    </div>
</div>
