 @extends('layouts.admin')
 <!--title-->
 @section('page_title', 'Categories')
 <!--End title-->
 @section('page')
     <!--nave-->
     @include('includes.admin.category_nav')
     <!--End nave-->
     <!--page-->
     <div class="items mt-5">
         <div class="accordion" id="accordionExample">
             <!-- mainCategories-->
             <div class="accordion-item">
                 <div class="accordion-header accordion-button " id="headingX">
                     <div class="row w-100">
                         <h4 class='col-12 col-sm  align-self-start'>Accordion Item #1
                             <!-- Button trigger category image modal -->
                             <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                 data-bs-target="#img_mainCategory">
                                 <i class="fa-regular fa-image"></i>
                             </button>
                             <!--END Button-->
                         </h4>
                         <div class="btn-group col-auto align-self-end" role="group"
                             aria-label="Basic mixed styles example">
                             <!-- Button remove mainCategory -->
                             <a href="#" class="btn btn-danger">
                                 <i class="fa-solid fa-trash"></i></a>
                             <!--END Button-->
                             <!-- Button trigger Edit mainCategory modal -->
                             <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                 data-bs-target="#edit_mainCategory">
                                 <i class="fa-solid fa-pen-to-square"></i></button>
                             <!--END Button-->
                             <!-- Button trigger create subCategory modal -->
                             <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                 data-bs-target="#create_subCategory">
                                 <i class="fa-solid fa-plus"></i></button>
                             <!--END Button-->
                             <button type="button" class=" btn btn-primary " data-bs-toggle="collapse"
                                 data-bs-target="#collapseX" aria-expanded="false" aria-controls="collapseX">
                                 <i class="fa-solid fa-angle-down"></i>
                             </button>
                         </div>
                     </div>
                 </div>
                 <!-- mainCategory image Modal -->
                 <div class="modal fade" id="img_mainCategory" tabindex="-1" aria-labelledby="img_mainCategoryLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h1 class="modal-title fs-5" id="staticBackdropLabel"> MainCategory title</h1>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <img src="{{ asset('assets/images/front/logo-c.png') }}" class="img-fluid"
                                     alt="category image">
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- END Modal-->
                 <!-- create subCategory Modal-->
                 <div class="modal fade" id="create_subCategory" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="create_subCategoryLabel" aria-hidden="true">
                     <div class="modal-dialog">
                         <form>
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="create_subCategoryLabel">Create Sub Category</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <div class="mt-3">
                                         <fieldset disabled>
                                             <label class="form-label">Select Main Category</label>
                                             <select class="form-select">
                                                 <option value="1">One</option>
                                             </select>
                                         </fieldset>
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
                 <!-- END Model -->
                 <!-- Edit mainCategory Modal -->
                 <div class="modal fade" id="edit_mainCategory" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="edit_mainCategoryLabel" aria-hidden="true">
                     <div class="modal-dialog">
                         <form>
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="edit_mainCategoryLabel">Edit Main Category</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <div class="my-3">
                                         <label for="exampleInputEmail1" class="form-label">Main Category Name</label>
                                         <input type="email" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp">
                                         <div class="my-3">
                                             <label for="formFile" class="form-label">Main Category image</label>
                                             <input class="form-control" type="file" id="formFile">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
                                     <button type="button" class="btn btn-primary">Edit</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
                 <!-- END Model -->
                 <!--subCategories-->
                 <div id="collapseX" class="accordion-collapse collapse show" aria-labelledby="headingX"
                     data-bs-parent="#accordionExample">
                     <div class="accordion-body">
                         <div class="container">
                             <div class="row ">
                                 <div class="col-auto m-2">
                                     <div class="  text-center py-2 px-3 border rounded-pill bg-light">
                                         <a href="#">Row column</a>
                                         <div class="btn-group btn-group-sm ms-2" role="group"
                                             aria-label="Small button group">
                                             <!-- Button remove subCategory -->
                                             <a href="#" class="btn btn-outline-dark">
                                                 <i class="fa-solid fa-trash"></i></a>
                                             <!--END Button-->
                                             <!-- Button trigger  Edit subCategory modal -->
                                             <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                                 data-bs-target="#edit_subCategory">
                                                 <i class="fa-solid fa-pen-to-square"></i></button>
                                             <!--END Button-->
                                             <!-- Button create product -->
                                             <a href="#" class="btn btn-outline-dark" data-bs-toggle="modal"
                                                 data-bs-target="#add_product">
                                                 <i class="fa-solid fa-plus"></i></a>
                                             <!--END Button-->
                                         </div>
                                     </div>
                                     <!-- Edit subCategory Modal -->
                                     <div class="modal fade" id="edit_subCategory" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_subCategoryLabel"
                                         aria-hidden="true">
                                         <div class="modal-dialog">
                                             <form>
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h1 class="modal-title fs-5" id="edit_subCategoryLabel">Edit
                                                             Sub Category</h1>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>
                                                     <div class="modal-body">
                                                         <div class="mt-3">
                                                             <fieldset disabled>
                                                                 <label class="form-label">Select Main Category</label>
                                                                 <select class="form-select">
                                                                     <option value="1">One</option>
                                                                 </select>
                                                             </fieldset>
                                                         </div>
                                                         <div class="my-3">
                                                             <label class="form-label">Sub Category Name</label>
                                                             <input type="text" class="form-control"
                                                                 aria-describedby="emailHelp">
                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <span type="button" class="btn btn-secondary"
                                                             data-bs-dismiss="modal">Close</span>
                                                         <button type="button" class="btn btn-primary">Edit</button>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                     <!-- END Model -->
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--END subCategories-->
             </div>
             <!-- END mainCategories-->
         </div>
     </div>








     <!--page-->
 @endsection

 @section('script')
     @parent
     <script>
         $(document).ready(function() {
             $('a.link').removeClass('active');
             $('#categories_link').addClass('active');
         });
     </script>

 @endsection
