<?php

use App\Http\Controllers\front\CategoryController;
use App\Http\Controllers\front\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:web')->group(function () {
    Route::get('viewCategory', [CategoryController::class, 'index']);
    Route::post('storeCategory', [CategoryController::class, 'store']);
    Route::put('/editCategory/{categories}', [CategoryController::class, 'update']);
    Route::post('delete', [CategoryController::class, 'delete']);
    Route::get('filter', [CategoryController::class, 'filter']);


    Route::get('viewProduct', [ProductController::class, 'index']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::get('productFilter', [ProductController::class, 'filter']);
    Route::post('storeProduct', [ProductController::class, 'store']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/updateProduct', [ProductController::class, 'update']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
