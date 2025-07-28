<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MainControllers extends Controller
{
    public function index(){
        $product = Product::orderBy('price', 'asc')->limit(4)->get();

        return view('home', compact('product'));
    }
}
