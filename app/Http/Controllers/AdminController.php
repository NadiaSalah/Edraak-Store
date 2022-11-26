<?php

namespace App\Http\Controllers;

use App\Models\MainSubCategory;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{


  public function categorieSsearch(Request $request)
  {
    $search = strip_tags($request->input('search'));
    if ($search != '' && strlen($search) > 2) {
      if ($request->searchBy == 'main') {
        $main_categories = MainCategory::where('name', 'like', "%$search%")
          ->orderBy('name')
          ->paginate(15);
        $main_categories->appends($request->all());
        if ($main_categories != null &&  $main_categories->count() > 0) {
          Session::flash('msg', ' successfull Searching for Main Category ');
          return view('admin.categories.index', compact('main_categories'));
        } else {
          Session::flash('error', 'Sorry , No searching result');
          return redirect()->back();
        }
      } elseif ($request->searchBy == 'sub') {
        $sub_categories = SubCategory::where('name', 'like', "%$search%")
          ->orderBy('name')
          ->paginate(6);
        $sub_categories->appends($request->all());

        if ($sub_categories != null &&  $sub_categories->count() > 0) {
          Session::flash('msg', ' successfull Searching for Main Category ');
          return view('admin.categories.sub-index', compact('sub_categories'));
        } else {
          Session::flash('error', 'Sorry , No searching result');
          return redirect()->back();
        }
      }
    } else {
      Session::flash('error', 'The searching word is very small " length >2 char "');
      return redirect()->back();
    }
  }

  public function mainSubDestroy($s_id, $m_id)
  {
    $del = MainSubCategory::where('main_category_id', $m_id)
      ->where('sub_category_id', $s_id)->first();
    if ($del !== null) {
      $del->delete();
      Session::flash('msg', 'Deleteing The Sub Category successfully');
    } else {
      Session::flash('error', ' The Sub Category not Deleted');
    }
    return redirect()->back();
  }


  public function productsSearch(Request $request){
    $search = strip_tags($request->input('search'));
    if ($search!='' && strlen($search) >2) {
        $products = Product::where('name', 'like', "%$search%")
            ->orderBy('name')
            ->paginate(15);
            $products->appends($request->all());

            if ($products != null &&  $products->count() > 0) {
              Session::flash('msg', ' successfull Searching for Product ');
              return view('admin.products.index', compact('products'));
            } else {
              Session::flash('error', 'Sorry , No searching result');
              return redirect()->back();
            }

    } else {
        Session::flash('error','the searching word is very small " length >2 char "');
        return redirect()->route('products.index');
    }


  }
}
