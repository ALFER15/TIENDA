
<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class,'login'])->name('login');

Route::group(['prefix' => 'v1','middleware'=>'auth:sanctum'], function () {
    Route::apiResource('products', ProductController::class);
});