<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RedirectController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', [RedirectController::class,'redirect'])->name('home');


Route::middleware(['auth','Verified'])->group(function(){
  Route::controller(AdminController::class)->group(function(){
    
  
  });

  
});

Route::get('admin/category',function(){
  return view('admin.categories.index');
})->name('admin.category');



require __DIR__ . '/auth.php';
