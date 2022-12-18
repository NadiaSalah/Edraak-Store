<?php

namespace App\Traits;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;

trait CallFunTrait
{
  public function imgPath($imgReq, $imgFolder)
  {
    $extention = strip_tags($imgReq->extension());
    $img_name = time() . '.' . $extention;
    $path = 'assets/images/' . $imgFolder . '/';
    $imgReq->move($path, $img_name);
    return  $path . $img_name;
  }


  public function categoryProducts($m_id, $s_id, $path)
  {
    $m_name = MainCategory::findOrFail($m_id)->name;
    $s_name = SubCategory::findOrFail($s_id)->name;
    $products = MainSubCategory::where('main_category_id', $m_id)
      ->where('sub_category_id', $s_id)
      ->first()->products()->paginate(6);
    if ($products !== null && count($products) != 0) {
      Session::flash('msg', 'All products for the selected category: ' . $m_name . '/' . $s_name);
      return view($path, compact('products'));
    } else {
      Session::flash('error', 'Sorry,No products for the selected category: ' . $m_name . '/' . $s_name);
      return redirect()->back();
    }
  }


  public function filterProducts(Request $request, $route)
  {
    $srting = "";
    if ($request->sizeCheck) {
      $request->validate([
        'size' => ['required'],
      ]);
      $size = Size::findOrFail(strip_tags($request->size));
      $products = $size->products()->where('quantity', '!=', 0);
      $srting .= ', size:' . $size->name;
    } else {
      $products = Product::where('quantity', '!=', 0);
    }
    if ($request->categoryCheck) {
      $request->validate([
        'category' => ['required'],
      ]);
      $ms_id = strip_tags($request->category);
      $products = $products->where('main_sub_category_id', $ms_id);
      $category = MainSubCategory::findOrFail($ms_id);
      $srting .= ', category:' . $category->mainCategory->name . '/' . $category->subCategory->name;
    }
    if ($request->return) {

      $products = $products->where('return', true);
      $srting .= ', Return Policy';
    }
    if ($request->discount) {
      $products = $products->where('discount', '!=', 0);
      $srting .= ', Discount';
    }
    if ($request->view) {
      $products = $products->where('view', 'hot');
      $srting .= ', Hot';
    }
    if ($request->priceCheck) {
      $request->validate([
        'min' => ['numeric'],
        'max' => ['numeric'],
      ]);
      $min = strip_tags($request->min);
      if ($min != 0) {
        $products = $products->where('price', '>', $min);
        $srting .= ', min price:' . $min . '$';
      }
      $max = strip_tags($request->max);
      if ($max != 0) {
        $products = $products->where('price', '<', $max);
        $srting .= ', max price:' . $max . '$';
      }
    }
    $products = $products->paginate(15);
    Session::flash('msg', 'Successfully,Filtering the products with "' . $srting . '".');
    return view($route, compact('products'));
  }
}
