<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;

class ProductController extends Controller
{
    public function index(){
        return response()->json([Product::with(['category','supplier'])]);
    }
}
