<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\MainSubCategory;
use App\Models\Product;
use App\Models\ProductSizeItem;
use App\Models\Size;
use App\Models\SubCategory;
use App\Traits\CallFunTrait;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use CallFunTrait;
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest  $request)
    {

        $products = new Product();

        $main_category = strip_tags($request->main_category);
        $sub_category = strip_tags($request->sub_category);
        $main_sub_category = MainSubCategory::where('main_category_id', $main_category)
            ->where('sub_category_id', $sub_category)
            ->first();

        if ($main_sub_category == null) {
            Session::flash('error', 'Sorry, some thing error');
            return redirect()->back();
        }
        $name = strip_tags($request->name);
        $main_sub = SubCategory::findOrFail($sub_category)->mainSubcategories;
        foreach ($main_sub as $item) {
            if (Product::where('name', $name)
                ->where('main_sub_category_id', $item->id)
                ->first()
            ) {
                Session::flash('error', 'Sorry, It is forbidden to repeat a product name "' . $name . '" in the same subcategory "' . SubCategory::findOrFail($sub_category) . '"');
                return redirect()->back();
            }
        }

        $products->name = $name;
        $products->main_sub_category_id = MainSubCategory::findOrFail($main_sub_category->id)->id;
        $products->description = strip_tags($request->description);
        $img = $request->file('image');
        $products->image = $this->imgPath($img, 'products');
        $products->quantity = strip_tags($request->quantity);
        $products->price = strip_tags($request->price);
        $products->discount = strip_tags($request->discount);
        if (strip_tags($request->return) == 'on') {
            $products->return = true;
        }
        if (strip_tags($request->view) == 'on') {
            $products->view = 'hot';
        }
        $sizeID = array();
        if ($request->size) {
            foreach ($request->size as $item) {
                $sizeID[] = $item;
            }
        }

        $products->save();
        if ($sizeID != null && count($sizeID) > 0) {
            foreach ($sizeID as $item) {
                ProductSizeItem::create([
                    'product_id' => $products->id,
                    'size_id' => Size::findOrFail($item)->id
                ]);
            }
        } else {
            ProductSizeItem::create([
                'product_id' => $products->id,
                'size_id' => Size::where('name', 'no')->first()->id
            ]);
        }

        Session::flash('msg', 'Storing The Product "' . $name . '" successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $products = Product::findOrFail($id);
        $main_category = strip_tags($request->main_category);
        $sub_category = strip_tags($request->sub_category);
        $main_sub_category = MainSubCategory::where('main_category_id', $main_category)
            ->where('sub_category_id', $sub_category)
            ->first();

        if ($main_sub_category == null) {
            Session::flash('error', 'Sorry, some thing error');
            return redirect()->back();
        }
        $name = strip_tags($request->name);
        $main_sub = SubCategory::findOrFail($sub_category)->mainSubcategories;
        foreach ($main_sub as $item) {
            if (Product::where('name', $name)
                ->where('main_sub_category_id', $item->id)
                ->first()
            ) {
                if (
                    Product::where('name', $name)
                    ->where('main_sub_category_id', $item->id)
                    ->first()->id != $products->id
                ) {
                    Session::flash('error', 'Sorry, It is forbidden to repeat a product name "' . $name . '" in the same subcategory "' . SubCategory::findOrFail($sub_category) . '"');
                    return redirect()->back();
                }
            }
        }

        $products->name = $name;
        $products->main_sub_category_id = MainSubCategory::findOrFail($main_sub_category->id)->id;
        $products->description = strip_tags($request->description);
        $img = $request->file('image');
        if ($img != null) {
            $products->image = $this->imgPath($img, 'products');
        }
        $products->quantity = strip_tags($request->quantity);
        $products->price = strip_tags($request->price);
        $products->discount = strip_tags($request->discount);
        if (strip_tags($request->return) == 'on') {
            $products->return = true;
        } else {
            $products->return = false;
        }
        if (strip_tags($request->view) == 'on') {
            $products->view = 'hot';
        } else {
            $products->view = 'normal';
        }
        $sizeID = array();
        if ($request->size) {
            foreach ($request->size as $item) {
                $sizeID[] = $item;
            }
        }

        $products->update();
        foreach($products->productSizeItems as $ps_item){
            $ps_item->forceDelete();
        }
        
        if ($sizeID != null && count($sizeID) > 0) {
            foreach ($sizeID as $item) {
                ProductSizeItem::create([
                    'product_id' => $products->id,
                    'size_id' => Size::findOrFail($item)->id
                ]);
            }
        } else {
            ProductSizeItem::create([
                'product_id' => $products->id,
                'size_id' => Size::where('name', 'no')->first()->id
            ]);
        }

        Session::flash('msg', 'Updating The Product "' . $name . '" successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
