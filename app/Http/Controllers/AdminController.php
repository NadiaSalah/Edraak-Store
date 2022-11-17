<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function categories_index(){
      $main_catrgories=MainCategory::all();
      $sub_catrgories=SubCategory::all();
      return view('admin.categories.index',compact('main_catrgories','sub_catrgories'));
    }
}
