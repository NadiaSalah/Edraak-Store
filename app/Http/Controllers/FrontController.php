<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Redirect;
use Session;

class FrontController extends Controller
{
   public function productShow($id)
   {
      $product = Product::findOrFail($id);
      return view('front.products.show', compact('product'));
   }

   public function productsIndex($m_id, $s_id)
   {
      $m_name = MainCategory::findOrFail($m_id)->name;
      $s_name = SubCategory::findOrFail($s_id)->name;
      $m_s_id = MainSubCategory::where('main_category_id', $m_id)
         ->where('sub_category_id', $s_id)
         ->first()->id;
      $p_categories = Product::where('main_sub_category_id', $m_s_id);
      if (count($p_categories->get()) != 0) {
         $products = $p_categories->paginate(6, ['*'], 'product');
         Session::flash('msg', 'All products for the selected category: ' . $m_name . '/' . $s_name);
         return view('front.products.index', compact('products'));
      } else {
         Session::flash('error', 'Sorry,No products for the selected category: ' . $m_name . '/' . $s_name);
         return redirect()->route('website');
      }
   }

   public function productsSearch(Request $request)
   {
      $search = strip_tags($request->input('search'));
      if ($search != '' && strlen($search) > 2) {
         $products = Product::where('name', 'like', "%$search%")
            ->orderBy('name')
            ->paginate(15);
         $products->appends($request->all());
         if ($products != null &&  $products->count() > 0) {
            Session::flash('msg', ' successfull Searching for Products with: ' . $search);
            return view('front.products.index', compact('products'));
         } else {
            Session::flash('error', 'Sorry, No searching result for:' . $search);
            return redirect()->back();
         }
      } else {
         Session::flash('error', 'the searching word is very small " length >2 char "');
         return redirect()->back();
      }
   }
}
