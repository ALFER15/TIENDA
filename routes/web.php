<?php

use App\Livewire\Catalogo\CreateCategory;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::get('/dashboard', function () {
         return view('dashboard');
     })->name('dashboard');
     Route::get('/branch', function () {
         return view('branch');
     })->name('branch');
     Route::get('/products', function(){
        return view('product');
     })->name('products');
     Route::get('/supplier', function () {
         return view('suppliers');
     })->name('supplier');
    //Route::get('/dashboard',CreateCategory::class)->name('dashboard');
});
    Route::get('/data',function(){
        $products = Product::with('supplier')->get();
        return $products()->name;
    });
