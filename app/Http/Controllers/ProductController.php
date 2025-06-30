<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\PhotoSession;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductHasPhotoSession;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Products - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.product.index', compact('title'));
    }

    public function create()
    {
        $title = "Products - Create";

        $productCategories = ProductCategory::get();
        $photoSessions = PhotoSession::get();

        return view('master.product.create', compact('title', 'productCategories', 'photoSessions'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $photo = $request->file('photo');

            if ($request->hasFile('photo')) {
                $tempPhoto = $photo->store('/images/product');

                $product = Product::create([
                    'product_category_id' => $request->product_category,
                    'name' => $request->name,
                    'type' => $request->type,
                    'description' => $request->description,
                    'price' => $request->price,
                    'photo' => $tempPhoto,
                ]);

                foreach ($request->photo_sessions as $sessionId) {
                    ProductHasPhotoSession::create([
                        'product_id' => $product->id,
                        'photo_session_id' => $sessionId,
                    ]);
                }
            }

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('product.index');
        } catch (\Exception $excep) {
            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        try {
            $productId = Crypt::decrypt($id);
            $data = Product::findOrFail($productId);

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('product.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('product.index');
        }
    }

    public function data()
    {
        $data = Product::with('category')
                        ->get()
                        ->map(function($product) {
                            $product->id = Crypt::encrypt($product->id);

                            return $product;
                        });

        return DataTables::of($data)
                        ->editColumn('type', function($item) {
                            return $item->type ? 'Indoor' : 'Outdoor';
                        })
                        ->editColumn('price', function($item) {
                            return 'Rp. ' . number_format($item->price, 2, ',', '.');
                        })
                        ->make(true);
    }
}
