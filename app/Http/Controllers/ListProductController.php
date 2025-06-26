<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Crypt;

class ListProductController extends Controller
{
    public function index()
    {
        $title = "List - Products";

        $products = Product::get();
        return view('master.list-product.index', compact('title', 'products'));
    }
    public function show_detail()
    {
        $title = "Detail - Products";
        $data = Product::with('category')
            ->get()
            ->map(function ($product) {
                $product->id = Crypt::encrypt($product->id);

                return $product;
            });
            return view('master.list-product.detail', compact('title', 'data'));
    }
}
