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
                    tabindex="-1" aria-labelledby="main_categoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="main_categoryLabel">Create Main Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="my-3">
                                        <label for="exampleInputEmail1" class="form-label">Main Category Name</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        <div class="my-3">
                                            <label for="formFile" class="form-label">Default file input example</label>
                                            <input class="form-control" type="file" id="formFile">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <button type="button" class="btn btn-primary">Create</button>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sub_category">
                    Create Sub Category
                </button>
                <!-- Modal -->
                <div class="modal fade" id="sub_category" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="sub_categoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="sub_categoryLabel">Create Sub Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-3">
                                        <label class="form-label">Select Main Category</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label class="form-label">Sub Category Name</label>
                                        <input type="text" class="form-control" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                    <button type="button" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end sub_category -->
        </div>
        <div class="search">
            <form class="d-flex flex-wrap flex-md-nowrap mt-3 mt-lg-0" role="search">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <label class="d-inline-block m-2"> by </label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>main category</option>
                    <option value="1">sub category</option>
                </select>
                <button class="btn btn-outline-success mx-2 my-3 my-md-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
