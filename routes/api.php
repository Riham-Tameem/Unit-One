<?php


use App\Http\Controllers\Api\CategoryController;

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('auth', [UserController::class, 'getAuthUser']);
    Route::get('viewCategory', [CategoryController::class, 'index']);
    Route::post('storeCategory', [CategoryController::class, 'store']);
    Route::put('/editCategory/{categories}', [CategoryController::class, 'update']);
    Route::post('delete', [CategoryController::class, 'delete']);
    Route::get('filter', [CategoryController::class, 'filter']);


    Route::get('viewProduct', [ProductController::class, 'index']);
    Route::get('productFilter', [ProductController::class, 'filter']);
    Route::post('storeProduct', [ProductController::class, 'store']);
    Route::put('/updateProduct/{products}', [ProductController::class, 'update']);


    Route::get('index', [EmployeeController::class, 'index']);
    Route::post('save', [\App\Http\Controllers\Api\EmployeeController::class, 'store']);
    Route::put('/editEmployee/{employees}', [EmployeeController::class, 'update']);
    Route::post('deleteEmployee', [EmployeeController::class, 'delete']);

});


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
