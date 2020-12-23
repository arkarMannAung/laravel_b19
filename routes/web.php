<?php
use Illuminate\Support\Facades\Route;
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

// Route::middleware('auth')->group(function () {
Route::middleware('role:admin')->group(function () {
	Route::resource('items','ItemsController');
	Route::resource('brands','BrandsController');
	Route::resource('subcategories','SubcategoryController');
	Route::resource('categories','CategoryController');
	Route::get('/dashboard','MyController@dashboard')->name('dashboard');
});

// auth
Auth::routes(['verify' => true]);

// frontend
Route::get('/','HomeController@home')->name('home');
Route::get('/ordersucess','HomeController@ordersucess')->name('ordersucess');
Route::get('/home','HomeController@home')->name('home');
Route::get('/item/detail','ItemsController@detail')->name('itemdetail');
Route::get('/cart/detail','ItemsController@cart')->name('cartdetail');
Route::get('/subcategory/detail','SubcategoryController@detail')->name('subcategorydetail');
Route::get('/brand/detail','BrandsController@detail')->name('branddetail');

// order
Route::resource('orders','OrderController');
Route::get('/orderdetail','OrderController@detail')->name('orderdetail');