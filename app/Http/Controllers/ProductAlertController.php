<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAlert;
use Auth;
use Illuminate\Http\Request;

class ProductAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'alert' => ['required','string','max:255']
        ]);
        $product = Product::findOrfail(strip_tags($request->productID));
        ProductAlert::create([
            'alert' => strip_tags($request->alert),
            'user_id' => Auth::User()->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAlert  $productAlert
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAlert $productAlert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAlert  $productAlert
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAlert $productAlert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAlert  $productAlert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAlert $productAlert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAlert  $productAlert
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAlert $productAlert)
    {
        //
    }
}
