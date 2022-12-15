<?php

namespace App\Http\Controllers;

use App\Models\MainSubCategory;
use App\Models\MainCategory;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Traits\CallFunTrait;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{

  use CallFunTrait;

  public function categoriesSearch(Request $request)
  {
    $search = strip_tags($request->input('search'));
    if ($search != '' && strlen($search) > 2) {
      if ($request->searchBy == 'main') {
        $main_categories = MainCategory::where('name', 'like', "%$search%")
          ->orderBy('name')
          ->paginate(6);
        $main_categories->appends($request->all());
        if ($main_categories != null &&  $main_categories->count() > 0) {
          $title = 'Search';
          Session::flash('msg', ' successfull Searching for Main Category ');
          return view('admin.categories.index', compact('main_categories', 'title'));
        } else {
          Session::flash('error', 'Sorry , No searching result for : ' . $search);
          return redirect()->back();
        }
      } elseif ($request->searchBy == 'sub') {
        $sub_categories = SubCategory::where('name', 'like', "%$search%")
          ->orderBy('name')
          ->paginate(6);
        $sub_categories->appends($request->all());
        if ($sub_categories != null &&  $sub_categories->count() > 0) {
          $title = 'Search';
          Session::flash('msg', ' successfull Searching for Main Category with : ' . $search);
          return view('admin.categories.sub-index', compact('sub_categories', 'title'));
        } else {
          Session::flash('error', 'Sorry , No searching result for : ' . $search);
          return redirect()->back();
        }
      }
    } else {
      Session::flash('error', 'The searching word is very small " length >2 char "');
      return redirect()->back();
    }
  }

  public function categoryDestroy($s_id, $m_id)
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


  public function productsSearch(Request $request)
  {
    $search = strip_tags($request->input('search'));
    if (is_numeric($search)) {
      $products = Product::where('id', $search)->paginate(1);
      if ($products->total() > 0) {
        $title = 'Search';
        Session::flash('msg', ' successfull Searching for Product with id#' . $search);
        return view('admin.products.index', compact('products', 'title'));
      } else {
        Session::flash('error', 'Sorry , No searching result for id#' . $search);
        return redirect()->back();
      }
    }
    if ($search != '' && strlen($search) > 2) {
      $products = Product::where('name', 'like', "%$search%")
        ->orderBy('name')
        ->paginate(6);
      $products->appends($request->all());
      if ($products != null &&  $products->count() > 0) {
        $title = 'Search';
        Session::flash('msg', ' successfull Searching for Product with  : ' . $search);
        return view('admin.products.index', compact('products', 'title'));
      } else {
        Session::flash('error', 'Sorry , No searching result for: ' . $search);
        return redirect()->back();
      }
    } else {
      Session::flash('error', 'the searching word "' . $search . '" is very small " length >2 char "');
      return redirect()->back();
    }
  }


  public function categoryProductCreate($m_id, $s_id)
  {
    $main_name = MainCategory::findOrFail($m_id)->name;
    $sub_name = SubCategory::findOrFail($s_id)->name;
    $category = [
      'main_id' => $m_id,
      'main_name' => $main_name,
      'sub_id' => $s_id,
      'sub_name' => $sub_name,
    ];
    Session::flash('msg', 'Create a Product for : ' . $main_name . '/' . $sub_name);
    return view('admin.products.create', compact('category'));
  }

  public function categoryProductsIndex($m_id, $s_id)
  {
    return $this->categoryProducts($m_id, $s_id, 'admin.products.index');
  }

  public function dashboardReports()
  {
    return view('admin.dashboard.reports');
  }
  // -----orders----------
  public function ordersSearch(Request $request)
  {
    $search = strip_tags($request->input('search'));
    if (is_numeric($search)) {
      $orderDetails = OrderDetail::where('id', $search)->paginate(1);
      if ($orderDetails->total() > 0) {
        $title = 'Search';
        Session::flash('msg', ' successfull Searching for Order Item with id#' . $search);
        return view('admin.orders.index', compact('orderDetails', 'title'));
      } else {
        Session::flash('error', 'Sorry , No searching result for id#' . $search);
        return redirect()->back();
      }
    } else {
      Session::flash('error', 'the searching word "' . $search . '" is a String, id is a number "');
      return redirect()->back();
    }
  }
  // -----users----------
  public function usersIndex()
  {
    $users = User::where('role', '!=', 0)->paginate(6, ['*'], 'users');
    return view('admin.users.index', compact('users'));
  }
  public function userActive($id)
  {
    $user = User::findOrFail($id);
    $user->status = true;
    $user->update();
    Session::flash('msg', 'the user id# ' . $user->id . '/' . $user->fist_name . 'is active now.');
    return redirect()->back();
  }
  public function userBlock($id)
  {
    $user = User::findOrFail($id);
    $user->status = false;
    $user->update();
    Session::flash('msg', 'the user id# ' . $user->id . '/' . $user->fist_name . 'is block now.');
    return redirect()->back();
  }
  public function usersBlocked()
  {
    $title = 'Blocked';
    $users = User::where('role', 1)->where('status', false)->paginate(6, ['*'], 'users');
    return view('admin.users.index', compact('users', 'title'));
  }
  public function usersActived()
  {
    $title = 'Actived';
    $users = User::where('role', 1)->where('status', true)->paginate(6, ['*'], 'users');
    return view('admin.users.index', compact('users', 'title'));
  }

  public function usersSearch(Request $request)
  {
    $search = strip_tags($request->input('search'));
    if (is_numeric($search)) {
      $users = User::where('role', 1)
        ->where('id', $search)
        ->paginate(1);
      if ($users->total() > 0) {
        $title = 'Search';
        Session::flash('msg', ' successfull Searching for User with id#' . $search);
        return view('admin.users.index', compact('users', 'title'));
      } else {
        Session::flash('error', 'Sorry , No searching result for id#' . $search);
        return redirect()->back();
      }
    }
    if ($search != '' && strlen($search) > 2) {
      $users = User::where('role', 1)->where('email', 'like', "%$search%")
        ->orderBy('email')
        ->paginate(6);
      $users->appends($request->all());
      if ($users != null &&  $users->count() > 0) {
        $title = 'Search';
        Session::flash('msg', ' successfull Searching for User with  : ' . $search);
        return view('admin.users.index', compact('users', 'title'));
      } else {
        Session::flash('error', 'Sorry , No searching result for: ' . $search);
        return redirect()->back();
      }
    } else {
      Session::flash('error', 'the searching word "' . $search . '" is very small " length >2 char "');
      return redirect()->back();
    }
  }
}
