<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;
use App\Traits\CallFunTrait;
use Route;

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
        $name=strip_tags($request->name);
        foreach(MainCategory::where('name', $name)->get() as $item){
            if($item->id !=$id){
                $request->validate([
                    'name' => ['unique:main_categories']
                ]);
            }
        }
        $main_categories->name =$name;
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
        MainCategory::findOrFail($id)->delete();
        Session::flash('msg', 'Archiving The Main Category successfully');
        return redirect()->back();
    }

    /*manual Admin function*/

    public function archive()
    {
        $main_categories = MainCategory::onlyTrashed()->paginate(15);
        return view('admin.categories.archive', compact('main_categories'));
    }

    public function forceDelete($id)
    {
        MainCategory::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        Session::flash('msg', 'Force delete the Main Category successfully');
        return redirect()->back();
    }
    public function restore($id)
    {
        MainCategory::withTrashed()
            ->where('id', $id)
            ->restore();
        Session::flash('msg', 'Restore the Main Category successfully');
        return redirect()->back();
    }

    public function archiveAll()
    {
        MainCategory::where('id', '!=', null)->Delete();
        Session::flash('msg', 'Archived all Main Categories successfully');
        return redirect()->back();
    }

    public function forceDeleteAll()
    {
        MainCategory::onlyTrashed()->forceDelete();
        Session::flash('msg', 'Force delete all archived Main Categories successfully');
        return redirect()->back();
    }

    public function restoreAll()
    {
        MainCategory::onlyTrashed()->restore();
        Session::flash('msg', 'Restore all archived Main Categories successfully');
        return redirect()->back();
        // return 'hello';
    }
}
