<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productsAPIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Route::group(['middleware'=>'guest'],function(){
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'store'])->name('register');
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'loginSupplier'])->name('login');

});




Route::group(['middleware'=>'auth'],function(){
Route::get('/home',[HomeController::class,'index'])->name('home');

Route::delete('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/product',[HomeController::class,'store'])->name('product');
Route::get('/view_products',[HomeController::class,'view'])->name('view_products');
Route::post('/getData',[HomeController::class,'getData'])->name('getData');
Route::post('/destroyProducts',[HomeController::class,'destroyProducts'])->name('destroyProducts');
Route::get('/editProducts/{id}',[HomeController::class,'editProducts'])->name('editProducts');
});


Route::get('active_products',[productsAPIController::class,'activeproducts'])->name('active_products');

Route::post('suplier_products',[productsAPIController::class,'suplier_products'])->name('suplier_products');

