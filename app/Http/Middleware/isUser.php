<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::User()->role == 1) {
            if (Auth::User()->status == 0) {
                Session::flash('error', 'You are Blocked by Admin, Please call us!');
                return redirect()->route('home');
            }
            return $next($request);
        } else {
            Session::flash('error', 'You are not User!');
            return redirect()->route('home');
        }
    }
}
