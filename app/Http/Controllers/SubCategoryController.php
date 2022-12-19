<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = subCategory::paginate(15);
        return view('admin.categories.sub-index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $name = strip_tags($request->name);
        $main_id = strip_tags($request->main);
        $subCategories = SubCategory::where('name', $name)->first();
        if ($subCategories != null && $subCategories->count() > 0) {
            if (
                MainSubCategory::where('main_category_id', $main_id)
                ->where('sub_category_id', $subCategories->id)->first()
            ) {
                Session::flash('error', 'Sorry sub category name must be unrepeated in the same main category');
            } else {
                MainSubCategory::create([
                    'main_category_id' => MainCategory::find($main_id)->id,
                    'sub_category_id' => $subCategories->id
                ]);
                Session::flash('msg', 'sub category name is added Successfully.');
            }
        } else {
            $sub = SubCategory::create([
                'name' => $name
            ]);
            MainSubCategory::create([
                'main_category_id' => MainCategory::find($main_id)->id,
                'sub_category_id' => subCategory::find($sub->id)->id
            ]);
            Session::flash('msg', 'sub category name is added Successfully.');
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = SubCategory::findOrFail($id)->products()->paginate(6);
        if ($products !== null && count($products) != 0) {
            Session::flash('msg', 'All Products for sub category "' . SubCategory::findOrFail($id)->name . '"');
            return view('admin.products.index', compact('products'));
        } else {
            Session::flash('error', 'Sorry No Products for sub category "' . SubCategory::findOrFail($id)->name . '"');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $name = strip_tags($request->name);
        $subCategories = SubCategory::findOrFail($id);
        $main_id = strip_tags($request->main);
        if ($subCategories->name != $name) {
            if ($main_id == null) { // for all main categories
                $request->validate([
                    'name' => ['unique:sub_Categories']
                ]);
                $subCategories->name = $name;
                $subCategories->update();
                Session::flash('msg', 'sub category name is updated Successfully.');
            } else {

                if (MainCategory::findOrFail($main_id)
                    ->subCategories
                    ->where('name', $name)
                    ->first()
                ) {
                    Session::flash('error', 'Sorry sub category name must be unrepeated in the same main category');
                } else {
                    $sub = SubCategory::where('name', $name)->first();
                    if ($sub == null) {
                        $sub = SubCategory::create([
                            'name' => $name
                        ]);
                    }
                    $ms_item = MainSubCategory::where('main_category_id', $main_id)
                        ->where('sub_category_id', $id)->get();
                    if ($ms_item->count() > 0) {
                        foreach ($ms_item as $item) {
                            $item->sub_category_id = $sub->id;
                            $item->save();
                        }
                    } else {
                        MainSubCategory::create([
                            'main_category_id' => MainCategory::find($main_id)->id,
                            'sub_category_id' => $sub->id
                        ]);
                    }
                    Session::flash('msg', 'sub category name is updated Successfully.');
                }
            }
        } else {
            Session::flash('error', 'Sorry, you enter same sub category name ');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        if ($sub_category->products->count() != 0) {
            $un_sub = SubCategory::where('name', 'unrecognized')->first();
            if (!($un_sub)) {
                $un_sub = SubCategory::create([
                    'name' => 'unrecognized'
                ]);
            }
            foreach ($sub_category->mainSubCategories as $ms_item) {
                $ms_item->sub_category_id =$un_sub->id;
                $ms_item->save();
            }
        }
        $sub_category->delete();
        Session::flash('msg', 'Deleting the SubCategory successfully');
        return redirect()->back();
    }
}
