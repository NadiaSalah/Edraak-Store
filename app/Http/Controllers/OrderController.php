<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderDetails = OrderDetail::orderBy('id', 'DESC')->paginate(6);
        return view('admin.orders.index', compact('orderDetails'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        if (is_numeric($status)) {
            $orderDetails = User::findOrFail($status)->orderDetails()
                ->orderBy('id', 'DESC')->paginate(6);
            $title ='For user id#' . $status;
        } else {
            $title = $status;
            $orderDetails = OrderDetail::where('status', $status)
                ->orderBy('id', 'DESC')->paginate(6);
        }
        return view('admin.orders.index', compact('orderDetails', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderDetails = OrderDetail::findOrFail($id);
        return view('admin.orders.show', compact('orderDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['status' => ['required']]);
        $status = strip_tags($request->status);
        $orderDetails = OrderDetail::findOrFail($id);
        $orderDetails->update([
            'status' => $status
        ]);
        if ($status == 'canceled') {
            $product = $orderDetails->productSize->product;
            $product->quantity +=  $orderDetails->quantity;
            $product->update();
        }
        return redirect()->back()
            ->with('msg', 'Successfuly change order status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
