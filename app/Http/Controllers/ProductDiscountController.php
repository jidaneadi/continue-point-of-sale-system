<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDiscountRequest;
use App\Http\Requests\UpdateProductDiscountRequest;
use App\Models\Product;
use App\Models\ProductDiscount;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProductDiscountController extends Controller
{
    public function index()
    {
        $title = "Discounts - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.product-discount.index', compact('title'));
    }

    public function create()
    {
        $title = "Discounts - Create";

        $products = Product::get();

        return view('master.product-discount.create', compact('title', 'products'));
    }

    public function store(StoreProductDiscountRequest $request)
    {
        try {
            $product = ProductDiscount::create([
                'product_id' => $request->product,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('discount.index');
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
        try {
            $title = "Discounts - Edit";

            $productId = Crypt::decrypt($id);
            $data = ProductDiscount::findOrFail($productId);
            $products = Product::get();

            return view('master.product-discount.edit', compact('title', 'data', 'products'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('discount.index');
        }
    }

    public function update(UpdateProductDiscountRequest $request, string $id)
    {
        try {
            $productId = Crypt::decrypt($id);
            $data = ProductDiscount::findOrFail($productId);

            $data->update([
                'product_id' => $request->product,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
    
            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('discount.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('discount.index');
        } catch (\Exception $excep) {
            Alert::error('Error', 'An error occurred while updating the discount.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $discountId = Crypt::decrypt($id);
            $data = ProductDiscount::findOrFail($discountId);

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('discount.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('discount.index');
        }
    }

    public function data()
    {
        $data = ProductDiscount::with('product')
                        ->get()
                        ->map(function($discount) {
                            $discount->id = Crypt::encrypt($discount->id);
                                    
                            return $discount;
                        });

        return DataTables::of($data)
                        ->editColumn('discount', function($item) {
                            return $item->discount . '%';
                        })
                        ->make(true);
    }
}
