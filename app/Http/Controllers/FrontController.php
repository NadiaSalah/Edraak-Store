<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\CallFunTrait;
use Auth;
use Illuminate\Http\Request;
use Session;

class FrontController extends Controller
{
   use CallFunTrait;

   //------website--------
   public function viewPolicy()
   {
      return view('front.home.policy');
   }

   //------products--------
   public function productShow($id)
   {
      $product = Product::findOrFail($id);
      return view('front.products.show', compact('product'));
   }

   public function categoryProductsIndex($m_id, $s_id)
   {
      return $this->categoryProducts($m_id, $s_id, 'front.products.index');
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
   public function productsFilter(Request $request)
   {
      return  $this->filterProducts( $request,'front.products.index'); 
   }
   //------ user--------

   public function userProfile()
   { // $user=User::findOrFail(Auth::User()->id);
      $user = Auth::user();
      return view('front.users.profile', compact('user'));
   }
}
