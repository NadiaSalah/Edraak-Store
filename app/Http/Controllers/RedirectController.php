<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class RedirectController extends Controller
{
    public function redirect()
    {
        if (Auth::User() !== null) {
            if (Auth::User()->role == 0) {
                return redirect()->route('admin.welcome');
            } else {
                return view('front.home.index');
            }
        } else {
            return view('front.home.index');
        }
    }

    public function website()
    {
        return view('front.home.index');
    }
}
