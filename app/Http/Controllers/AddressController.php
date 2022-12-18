<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Auth;
use Session;
use App\Http\Requests\AddressRequest;


class AddressController extends Controller
{

    public function index()
    {
        $addresses =  Address::where('user_id', Auth::User()->id)->paginate(6);
        return view('front.users.addresses',compact('addresses'));
    }


    public function create()
    {
        //
    }


    public function store(AddressRequest $request)
    {
        $userID = strip_tags($request->userID);
        $user = User::findOrFail($userID);
        Address::create([
            'name' => strip_tags($request->name),
            'phone' => strip_tags($request->phone),
            'address_line_1' => strip_tags($request->address_line_1),
            'address_line_2' => strip_tags($request->address_line_2),
            'city' => strip_tags($request->city),
            'state' => strip_tags($request->state),
            'country' => strip_tags($request->country),
            'postal_code' => strip_tags($request->postal_code),
            'user_id'  => $user->id,
        ]);

        Session::flash('msg', 'Address is added Successfully');
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(AddressRequest $request, $id)
    {
        $userID = strip_tags($request->userID);
        $user = User::findOrFail($userID);
        $address = Address::findOrFail($id);
        $address->update([
            'name' => strip_tags($request->name),
            'phone' => strip_tags($request->phone),
            'address_line_1' => strip_tags($request->address_line_1),
            'address_line_2' => strip_tags($request->address_line_2),
            'city' => strip_tags($request->city),
            'state' => strip_tags($request->state),
            'country' => strip_tags($request->country),
            'postal_code' => strip_tags($request->postal_code),
            'user_id'  => $user->id,
        ]);

        Session::flash('msg', 'Address is updated Successfully');
        return redirect()->route('addresses.index');
    }


    public function destroy($id)
    { //return 'xx';
        Address::findOrFail($id)->delete();
        Session::flash('msg', 'Address is deleted Successfully');
        return redirect()->route('addresses.index');
    }
}
