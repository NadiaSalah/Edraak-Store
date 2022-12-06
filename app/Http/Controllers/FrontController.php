<?php

namespace App\Http\Controllers;

use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\Size;
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
      $srting = "";
      if ($request->sizeCheck) {
         $request->validate([
            'size' => ['required'],
         ]);
         $size = Size::findOrFail(strip_tags($request->size));
         $products = $size->products()->where('quantity', '!=', 0);
         $srting .=', size:'.$size->name;
      } else {
         $products = Product::where('quantity', '!=', 0);
      }
      if ($request->categoryCheck) {
         $request->validate([
            'category' => ['required'],
         ]);
         $ms_id = strip_tags($request->category);
         $products = $products->where('main_sub_category_id', $ms_id);
         $category=MainSubCategory::findOrFail($ms_id);
         $srting .=', category:'.$category->mainCategory->name.'/'.$category->subCategory->name;
      }
      if ($request->priceCheck) {
         $request->validate([
            'min' => ['numeric'],
            'max' => ['numeric'],
         ]);
         $min = strip_tags($request->min);
         if ($min != 0) {
            $products = $products->where('price', '>', $min);
            $srting .=', min price:'.$min.'$';
         }
         $max = strip_tags($request->max);
         if ($max != 0) {
            $products = $products->where('price', '<', $max);
            $srting .=', max price:'.$max.'$';
         }
      }
      $products = $products->paginate(15);
      Session::flash('msg', 'Successfully,Filtering the products with "'.$srting.'".');
      return view('front.products.index', compact('products'));
   }
   //------ user--------

   public function userProfile()
   { // $user=User::findOrFail(Auth::User()->id);
      $user = Auth::user();
      return view('front.users.profile', compact('user'));
   }
}
