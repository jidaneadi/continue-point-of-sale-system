<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PhotoSession;
use Illuminate\Support\Facades\Crypt;

class ListProductController extends Controller
{
    public function index()
    {
        $title = "List - Products";

        $products = Product::get();
        return view('master.list-product.index', compact('title', 'products'));
    }
    public function show_detail(string $id)
    {
        $title = "Detail - Products";
        $data = Product::with('category')->findOrFail($id);
        $sessionPhoto = PhotoSession::where('code','like','%IS%')->get();
            return view('master.list-product.detail', compact('title', 'data', 'sessionPhoto'));
    }
}
