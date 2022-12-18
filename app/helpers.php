<?php

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductAlert;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Carbon;

if (!function_exists('getMainCategories')) {
  function getMainCategories()
  {
    return MainCategory::all();
  }
}

if (!function_exists('getsubCategories')) {
  function getsubCategories()
  {
    return SubCategory::all();
  }
}

if (!function_exists('getMainSubCategories')) {
  function getMainSubCategories()
  {
    return MainSubCategory::all();
  }
}


if (!function_exists('getProducts')) {
  function getProducts()
  {
    return Product::orderBy('id', 'desc')->paginate(6, ['*'], 'product');
  }
}

if (!function_exists('getHotProducts')) {
  function getHotProducts()
  {
    return Product::where('view', 'hot')
      ->where('quantity', '!=', 0)
      ->orderBy('id', 'desc')
      ->paginate(3, ['*'], 'hot');
  }
}

if (!function_exists('getSaleProducts')) {
  function getSaleProducts()
  {
    return Product::where('discount', '!=', 0)
      ->where('quantity', '!=', 0)
      ->orderBy('id', 'desc')
      ->paginate(3, ['*'], 'sale');
  }
}

if (!function_exists('getPremiumProducts')) {
  function getPremiumProducts()
  {
    return Product::where('discount', '!=', 0)
      ->where('return', true)
      ->where('quantity', '!=', 0)
      ->orderBy('id', 'desc')
      ->paginate(3, ['*'], 'premium');
  }
}

if (!function_exists('getRecommendedProducts')) {
  function getRecommendedProducts()
  {
    $user_ordersDetails = Auth::user()->orderdetails;
    if($user_ordersDetails->count() >0){
    $products_count = array();
    foreach ($user_ordersDetails as $uod_item) {
      $products_count[$uod_item->id] =   $uod_item->product->id;
    }
    $product_id = max(array_count_values($products_count));
    $product = Product::findOrFail($product_id);
    $products = Product::where('quantity', '!==', 0)
      ->where('main_sub_category_id', $product->main_sub_category_id)
      ->orwhere('discount', '>', $product->discount)
      ->where('return', true)
      ->orderBy('id','DESC')
      ->paginate(3, ['*'], 'recommended');
  } else{
    $products=Product::where('id','-1')
    ->paginate(3, ['*'], 'recommended');
  }
    return  $products;
  }
}

if (!function_exists('getSizes')) {
  function getSizes()
  {
    return Size::all();
  }

  if (!function_exists('getUsers')) {
    function getUsers()
    {
      return User::where('role', 1);
    }
  }

  if (!function_exists('getBlockedUsers')) {
    function getBlockedUsers()
    {
      return User::where('role', 1)->where('status', false);
    }
  }

  if (!function_exists('getActivedUsers')) {
    function getActivedUsers()
    {
      return User::where('role', 1)->where('status', true);
    }
  }


  if (!function_exists('getAlerts')) {
    function getAlerts()
    {
      return ProductAlert::orderBy('id', 'desc')->paginate(3, ['*'], 'alerts');
    }
  }
  if (!function_exists('getOrderDetails')) {
    function getOrderDetails()
    {
      return OrderDetail::all();
    }
  }

  if (!function_exists('getmonthOrderDetails')) {
    function getmonthOrderDetails()
    {
      return OrderDetail::where("created_at", ">", Carbon::now()->subMonths(1));
    }
  }

  if (!function_exists('orderAction')) {
    function orderAction($status)
    {
      if ($status == 'processing') {
        $action = 'shipped';
      } elseif ($status == 'shipped') {
        $action = 'delivered';
      } elseif ($status == 'delivered') {
        $action = 'complete';
      } else {
        $action = null;
      }
      return  $action;
    }
  }

  if (!function_exists('allOrderStatus')) {
    function allOrderStatus()
    {
      return array('processing', 'shipped', 'delivered', 'complete', 'canceled');
    }
  }

  if (!function_exists('orderStatusCalss')) {
    function orderStatusCalss($status)
    {
      if ($status == 'processing') {
        $class = 'info';
      } elseif ($status == 'shipped') {
        $class = 'warning';
      } elseif ($status == 'delivered') {
        $class = 'primary';
      } elseif ($status == 'complete') {
        $class = 'success';
      } elseif ($status == 'canceled') {
        $class = 'danger';
      } else {
        $class = null;
      }
      return  $class;
    }
  }

  if (!function_exists('getOrderStatus')) {
    function getOrderStatus($id)
    {
      if (is_numeric($id)) {
        $order = Order::findOrFail($id);
        $orderdetails = $order->orderdetails;
      } else {
        $orderdetails = OrderDetail::all();
      }
      $status = array();
      foreach (allOrderStatus() as $s_item) {
        $status[$s_item] = $orderdetails->where('status', $s_item)->count();
      }
      return $status;
    }
  }
}
