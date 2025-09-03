<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowListProductRequest;
use App\Models\PhotoSession;
use App\Models\Product;
use App\Models\ProductCategory;

class MasterController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('price', 'asc')->limit(4)->get();

        return view('master.home', compact('product'));
    }
}
