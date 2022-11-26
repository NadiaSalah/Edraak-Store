<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect()
    {
        if (Auth::User() !== null) {
            if (Auth::User()->role == 0) {
                return redirect()->route('admin.welcome');
            } else {
                return view('front.home');
            }
        } else {
            return view('front.home');
        }
    }
}
