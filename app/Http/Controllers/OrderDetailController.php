<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::User()->id)
        ->orderBy('id', 'desc')->paginate(6);
        return view('front.orders.index', compact('orders'));
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
            'payment' => ['required'],
            'addressID' => ['required']
        ]);

        $user_id = Auth::User()->id;
        $address_id = Auth::user()->addresses->where('id', $request->addressID)->first()->id;
        if ($request->payment != 0 && $address_id->count() == 0) {
            return redirect()->back()->with('error', 'Sorry, Some thing error');
        }
        $order = Order::create([
            'user_id' => $user_id,
            'address_id' => $address_id,
            'total_quantity' => 0,
            'final_price' => 0,
            'payment' => 0,
        ]);
        $total_quantity = 0;
        $final_price = 0;
        foreach (Auth::user()->carts as $c_item) {
            $product = Product::findOrFail($c_item->productSize->product->id);
            $price = $product->price * (1 - $product->discount / 100);
            $quantity = $c_item->quantity;
            $total_quantity += $quantity;
            $total_price = $price * $c_item->quantity;
            $final_price += $total_price;
            OrderDetail::create([
                'order_id' => $order->id,
                'product_size_id' => $c_item->product_size_id,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' =>  $total_price,
            ]);
            $product->quantity -=  $quantity;
            $product->update();
            Cart::findOrFail($c_item->id)->delete();
        }
        $order->total_quantity = $total_quantity;
        $order->final_price = $final_price;
        $order->update();
        return redirect()->route('orderDetails.index')
            ->with('msg', 'Your Order is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('front.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
