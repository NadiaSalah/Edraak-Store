<nav class="navbar py-5 py-lg-3 bg-light">
    <div class="container-fluid">
        <div class="creat  d-flex flex-column  flex-sm-row">
            <!-- main_category -->
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#main_category">
                    Create Main Category
                </button>
                <!-- Modal -->
                <div class="modal fade" id="main_category" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('mainCategories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Create Main Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="my-3">
                                        <label class="form-label">Main Category Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                        <div class="my-3">
                                            <label class="form-label">Main Category image</label>
                                            <input name="image" class="form-control" type="file" id="formFile">
                                            <div id="textHelp1" class="form-text">not required.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <button type="submit" class="btn btn-primary">Store</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end main_category -->
            <!-- sub_category -->
            <div class="m-2 m-sm-0">
                <!-- Button trigger modal -->
                @if (getMainCategories()->count() > 0)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#sub_category">
                        Create Sub Category
                    </button>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="sub_category" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('subCategories.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Create Sub Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-3">
                                        <label class="form-label">Select Main Category</label>
                                        <select name="main" class="form-select" required>
                                            @forelse (getMainCategories() as $main_item_nav)
                                                <option value="{{ $main_item_nav->id }}"> {{ $main_item_nav->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label class="form-label">Sub Category Name</label>
                                        <input name="name" type="text" class="form-control"
                                            aria-describedby="textHelp" required value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <button type="submit" class="btn btn-primary">Store</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end sub_category -->
        </div>
        <div class="search">
            <form action="{{ route('categories.search') }}" method="GET"
                class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                <input name="search" class="form-control " type="search" placeholder="Category Name" required>
                <label class="d-inline-block m-2"> by </label>
                <select name="searchBy" class="form-select" required>
                    <option value="main" selected>main category</option>
                    <option value="sub">sub category</option>
                </select>
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit"> Search </button>
            </form>
        </div>
    </div>
</nav>
