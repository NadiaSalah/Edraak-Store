<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductAlertController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SubCategoryController;
use App\Models\OrderDetail;
use App\Models\ProductAlert;
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



Route::controller(RedirectController::class)->group(function () {
  Route::get('/', 'redirect')->name('home');
  Route::get('/front', 'website')->name('website');
  Route::get('admin/welcome', 'adminWelcome')->name('admin.welcome');
});

Route::prefix('home')->group(function () {
  Route::controller(FrontController::class)->group(function () {
    Route::get('products/{id}', 'productShow')->name('productsFront.show');
    Route::get('products.search', 'productsSearch')->name('ProductsFront.search');
    Route::get('products.filter', 'productsFilter')->name('ProductsFront.filter');
    Route::get('categories/products/{m_id}/{s_id}', 'categoryProductsIndex')->name('ProductsFront.index');
    Route::get('policy', 'viewPolicy')->name('policy');
  });
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
  Route::resources([
    'mainCategories' => MainCategoryController::class,
    'subCategories' => SubCategoryController::class,
    'products' => ProductController::class,
    'orders' => OrderController::class,
  ]);
  Route::resource('productAlerts', ProductAlertController::class)->only(['index', 'show', 'destroy']);
  Route::controller(MainCategoryController::class)->group(function () {
    Route::get('mainCategories.archive', 'archive')->name('mainCategories.archive');
    Route::get('mainCategories.restoreAll', 'restoreAll')->name('mainCategories.restoreAll');
    Route::get('mainCategories/restore/{id}', 'restore')->name('mainCategories.restore');
    Route::get('mainCategories.forceDeleteAll', 'forceDeleteAll')->name('mainCategories.forceDeleteAll');
    Route::get('mainCategories/forceDelete/{id}', 'forceDelete')->name('mainCategories.forceDelete');
  });
  Route::controller(SubCategoryController::class)->group(function () {
    Route::get('subCategories.archive', 'archive')->name('subCategories.archive');
    Route::get('subCategories.restoreAll', 'restoreAll')->name('subCategories.restoreAll');
    Route::get('subCategories/restore/{id}', 'restore')->name('subCategories.restore');
    Route::get('subCategories.forceDeleteAll', 'forceDeleteAll')->name('subCategories.forceDeleteAll');
    Route::get('subCategories/forceDelete/{id}', 'forceDelete')->name('subCategories.forceDelete');
  });
  Route::controller(AdminController::class)->group(function () {
    Route::get('categories.search', 'categoriesSearch')->name('categories.search');
    Route::get('categories/destroy/{s_id}/{m_id}', 'categoryDestroy')->name('categories.destroy');
    Route::get('categories/products/create/{m_id}/{s_id}', 'categoryProductCreate')->name('categoryProducts.create');
    Route::get('categories/products/{m_id}/{s_id}', 'categoryProductsIndex')->name('categoryProducts.index');
    Route::get('dashboard/reports', 'dashboardReports')->name('dashboard.reports');
    Route::get('dashboard/setting', 'dashboardSetting')->name('dashboard.setting');
    Route::get('products.search', 'productsSearch')->name('products.search');
    Route::get('products/archive', 'productsArchive')->name('products.archive');
    Route::get('users.index', 'usersIndex')->name('users.index');
    Route::get('users.blocked', 'usersBlocked')->name('users.blocked');
    Route::get('users.actived', 'usersActived')->name('users.actived');
    Route::get('users/active/{id}', 'userActive')->name('users.active');
    Route::get('users/block/{id}', 'userBlock')->name('users.block');
    Route::get('users.search', 'usersSearch')->name('users.search');
  });
});

Route::prefix('user')->middleware(['auth', 'isUser'])->group(function () {
  Route::resources([
    'carts' => CartController::class,
    'addresses' => AddressController::class,
    'orderDetails'=>OrderDetailController::class,
  ]);
  Route::resource('productAlerts', ProductAlertController::class)->only(['store']);
  Route::controller(FrontController::class)->group(function () {
    Route::get('profile', 'userProfile')->name('users.profile');
  });
});




require __DIR__ . '/auth.php';
