<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowListProductRequest;
use App\Models\PhotoSession;
use App\Models\Product;
use App\Models\ProductCategory;

class MainControllers extends Controller
{
    public function index(){
        $product = Product::orderBy('price', 'asc')->limit(4)->get();

        return view('home', compact('product'));
    }
    public function show(ShowListProductRequest $request)
    {
        $title = "List - Products";

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('product_category_id', $request->category);
        }
        if ($request->has('order')) {
            switch ($request->order) {
                case 'termurah':
                    $query->orderBy('price', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('price', 'desc');
                    break;
                case 'kategori':
                    $query->orderBy('product_category_id', 'asc');
                    break;
            }
        }
        $products = $query->get();
        $kategories = ProductCategory::get();
        $sessionPhoto = PhotoSession::where('code', 'like', '%IS%')->get();
        $sessionOutdoor = PhotoSession::where('code', 'like', '%OS%')->get();
        return view('product', compact('title', 'products', 'kategories', 'sessionPhoto', 'sessionOutdoor'));
    }
}
