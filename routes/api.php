<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//todas las APIS se versionan, es decir:
//es basicamente una instruccion que nos permite identificar la forma en la que cambia el modelo de dato

Route::group(['prefix'=>'v1'],function(){
    Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
});
