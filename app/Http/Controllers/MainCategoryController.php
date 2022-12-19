<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use Session;
use App\Traits\CallFunTrait;


class MainCategoryController extends Controller
{

    use CallFunTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = MainCategory::paginate(15);
        return view('admin.categories.index', compact('main_categories'));
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
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:main_Categories']
        ]);

        $main_categories = new MainCategory();
        $main_categories->name = strip_tags($request->name);
        $img = $request->file('image');
        if ($img != null) {
            $main_categories->image = $this->imgPath($img, 'main-categories');
        }
        $main_categories->save();
        Session::flash('msg', 'Storing The Main Category successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $main_categories = MainCategory::findOrFail($id);
        $name = strip_tags($request->name);
        foreach (MainCategory::where('name', $name)->get() as $item) {
            if ($item->id != $id) {
                $request->validate([
                    'name' => ['unique:main_categories']
                ]);
            }
        }
        $main_categories->name = $name;
        $img = $request->file('image');
        if ($img != null) {
            $main_categories->image = $this->imgPath($img, 'main-categories');
        }
        $main_categories->update();
        Session::flash('msg', 'Updating The Main Category successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $main_category = MainCategory::findOrFail($id);
        if ($main_category->products->count() != 0) {
            if (!($un_main = MainCategory::where('name', 'unrecognized')->first())) {
                $un_main = MainCategory::create([
                    'name' => 'unrecognized'
                ]);
            }
            foreach ($main_category->mainSubCategories as $ms_item) {
                $ms_item->main_category_id = $un_main->id;
                $ms_item->save();
            }
        }
        $main_category->delete();
        Session::flash('msg', 'Deletinging The Main Category successfully');
        return redirect()->back();
    }

}
