<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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


Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/products', [AdminController::class, 'product']);

Route::post('/uploadproducts', [AdminController::class, 'uploadproduct']);

Route::get('/showproducts', [AdminController::class, 'showproduct']);

Route::get('/deleteproducts/{id}', [AdminController::class, 'deleteproduct']);

Route::get('/updateproducts/{id}', [AdminController::class, 'updateproduct']);

Route::post('/editproducts/{id}', [AdminController::class, 'editproduct']);

Route::get('/search',[HomeController::class, 'search']);

Route::post('/addcart/{id}',[HomeController::class, 'addcart']);

Route::get('/showcarts',[HomeController::class, 'showcart']);

Route::get('/deletecarts/{id}', [HomeController::class, 'deletecart']);

Route::post('order', [HomeController::class, 'confirmorder']);


