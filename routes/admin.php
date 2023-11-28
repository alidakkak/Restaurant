<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\ProductController;
use App\Types\UserTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group([ 'middleware' => 'check_user:'.UserTypes::ADMIN], function () {
    Route::post('category/{category}/',[CategoryController::class,'update']);
    Route::apiResource('category',CategoryController::class)->except("update","show");
    Route::post('product/{product}/',[ProductController::class,'update']);
    Route::apiResource('product',ProductController::class)->except("update","show");
    Route::post('ingredient/{ingredient}/',[IngredientController::class,'update']);
    Route::apiResource('ingredient',IngredientController::class)->except("update","show");
    Route::apiResource('tables',IngredientController::class)->except("show");

});
