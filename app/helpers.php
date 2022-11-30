<?php

use App\Models\MainCategory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;

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
}
