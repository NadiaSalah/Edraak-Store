<?php 
use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;

if (! function_exists('getMainCategories')) {
  function getMainCategories()
  {
    return MainCategory::all();
  }
}

if (! function_exists('getsubCategories')) {
  function getsubCategories()
  {
    return SubCategory::all();
  }
}

if (! function_exists('getproductCategories')) {
  function getproductCategories($mainSub_id)
  {
    return MainSubCategory::findOrfail($mainSub_id);
  }
}

if (! function_exists('getProducts')) {
  function getProducts()
  {
    return Product::all();
  }
}

if (! function_exists('getSizes')) {
  function getSizes()
{
  return Size::all();
}
}

