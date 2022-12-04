<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSizeItem;
use App\Models\Size;
use Auth;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::User()->id)->paginate(6);
        return view('front.carts.index', compact('carts'));
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
            'quantity' => ['required', 'integer', 'min:0'],
            'sizeID' => ['required'],
            'productID' => ['required'],
        ]);
        $product = Product::findOrFail(strip_tags($request->productID));
        $quantity = strip_tags($request->quantity);
        if ($quantity == 0) {
            Session::flash('error', 'Sorry, you Enter Zero quantity.');
            return redirect()->back();
        } elseif ($quantity > $product->quantity) {
            Session::flash('error', 'Sorry, the product out of stock');
            return redirect()->back();
        }
        $size_id = Size::findOrFail(strip_tags($request->sizeID))->id;
        if ($product_size = ProductSizeItem::where('product_id', $product->id)
            ->where('size_id', $size_id)->first()
        ) {
            $product_size_id = $product_size->id;
        } else {
            Session::flash('error', 'there is some thing wrong');
            return redirect()->back();
        }
        $user_id = Auth::User()->id;
        if ($cart = Cart::where('user_id', $user_id)
            ->where('product_size_id', $product_size_id)->first()
        ) {
            return self::class::update($request, $cart->id);
        }
        $cart = Cart::create([
            'user_id' => $user_id,
            'product_size_id' => $product_size_id,
            'quantity' => $quantity,
        ]);
        Session::flash('msg', 'Adding the product "' . $product->name . '" to your cart Successflly.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:0'],
            'sizeID' => ['required'],
            'productID' => ['required'],
        ]);

        $cart = Cart::findOrFail($id);
        $user_id = Auth::User()->id;
        $product = Product::findOrFail(strip_tags($request->productID));
        $quantity = strip_tags($request->quantity);
        if ($quantity == 0) {
            Session::flash('error', 'Sorry, you Enter Zero quantity.');
            return redirect()->back();
        } elseif ($quantity > $product->quantity) {
            Session::flash('error', 'Sorry, the product out of stock');
            return redirect()->back();
        }
        $size_id = Size::findOrFail(strip_tags($request->sizeID))->id;
        if (!($product_size = ProductSizeItem::where('product_id', $product->id)
            ->where('size_id', $size_id)->first()) || $cart->user_id != $user_id) {
            Session::flash('error', 'there is some thing wrong');
            return redirect()->back();
        }
        $cart->quantity = $quantity;
        $cart->update();
        Session::flash('msg', 'Updating the product "' . $product->name . '" to your cart Successflly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        Session::flash('msg', 'Deleting the product "' . $cart->productSize->product->name . '"from your cart Successflly.');
        return redirect()->back();
    }
}
