<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\MainSubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Route;
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
    public function show(SubCategory $subCategory)
    {
        //
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
                    if ($ms_item->count()>0) {
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
        SubCategory::findOrFail($id)->delete();
        Session::flash('msg', 'Archiving the SubCategory successfully');
        return redirect()->back();
    }

    /*manual Admin function*/


    public function archive()
    {
        $sub_categories = SubCategory::onlyTrashed()->paginate(15);
        return view('admin.categories.sub-archive', compact('sub_categories'));
    }

    public function forceDelete($id)
    {
        MainCategory::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        Session::flash('msg', 'Force delete the SubCategory successfully');
        return redirect()->back();
    }
    public function restore($id)
    {
        SubCategory::withTrashed()
            ->where('id', $id)
            ->restore();
        Session::flash('msg', 'Restore the SubCategory successfully');
        return redirect()->back();
    }

    public function archiveAll()
    {
        SubCategory::where('id', '!=', null)->Delete();
        Session::flash('msg', 'Archived all Sub Categories successfully');
        return redirect()->back();
    }

    public function forceDeleteAll()
    {
        SubCategory::onlyTrashed()->forceDelete();
        Session::flash('msg', 'Force delete all archived Sub Categories successfully');
        return redirect()->back();
    }

    public function restoreAll()
    {
        SubCategory::onlyTrashed()->restore();
        Session::flash('msg', 'Restore all archived Sub Categories successfully');
        return redirect()->back();
    }
}
