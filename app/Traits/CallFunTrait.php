<?php

namespace App\Traits;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
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


  public function categoryProducts($m_id,$s_id,$path){
    $m_name = MainCategory::findOrFail($m_id)->name;
    $s_name = SubCategory::findOrFail($s_id)->name;
    $products = MainSubCategory::where('main_category_id', $m_id)
      ->where('sub_category_id', $s_id)
      ->first()->products()->paginate(6);
    if ($products!== null && count($products) != 0) {
      Session::flash('msg', 'All products for the selected category: ' . $m_name . '/' . $s_name);
      return view($path, compact('products'));
    } else {
      Session::flash('error', 'Sorry,No products for the selected category: ' . $m_name . '/' . $s_name);
      return redirect()->back();
    }
  }
}
