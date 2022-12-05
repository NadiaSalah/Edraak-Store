<?php

use App\Models\MainCategory;
use App\Models\Product;
use App\Models\ProductAlert;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\User;

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


if (!function_exists('getProducts')) {
  function getProducts()
  {
    return Product::paginate(6, ['*'], 'product');
  }
}

if (!function_exists('getHotProducts')) {
  function getHotProducts()
  {
    return Product::where('view', 'hot')
      ->where('quantity', '!=', 0)
      ->paginate(3, ['*'], 'hot');
  }
}

if (!function_exists('getSaleProducts')) {
  function getSaleProducts()
  {
    return Product::where('discount', '!=', 0)
      ->where('quantity', '!=', 0)
      ->paginate(3, ['*'], 'sale');
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
      return User::where('role', 1)->where('status',false);
    }
  }

  if (!function_exists('getActivedUsers')) {
    function getActivedUsers()
    {
      return User::where('role', 1)->where('status',true);
    }
  }


  if (!function_exists('getAlerts')) {
    function getAlerts()
    {
      return ProductAlert::paginate(3, ['*'], 'alerts');
    }
  }

}
