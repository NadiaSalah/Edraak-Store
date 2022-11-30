<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\CallFunTrait;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Redirect;
use Session;

class FrontController extends Controller
{
use CallFunTrait;

   public function productShow($id)
   {
      $product = Product::findOrFail($id);
      return view('front.products.show', compact('product'));
   }

   public function categoryProductsIndex($m_id, $s_id)
   {
      return $this->categoryProducts($m_id, $s_id,'front.products.index');
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
