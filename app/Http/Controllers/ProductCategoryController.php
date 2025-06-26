<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $title = "Product Categories - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.product-category.index', compact('title'));
    }

    public function create()
    {
        $title = "Product Categories - Create";

        return view('master.product-category.create', compact('title'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        try {
            $data = ProductCategory::create([
                'code' => $request->code,
                'name' => $request->name,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('product-category.index');
        } catch (\Exception $excep) {
            Alert::error('Error', 'An error occurred while adding the role.');
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
            $title = "Product Categories - Edit";

            $productCategoryId = Crypt::decrypt($id);
            $data = ProductCategory::findOrFail($productCategoryId);

            return view('master.product-category.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('product-category.index');
        }
    }

    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        try {
            $productCategoryId = Crypt::decrypt($id);
            $data = ProductCategory::findOrFail($productCategoryId);

            $data->update([
                'code' => $request->code,
                'name' => $request->name,
            ]);
    
            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('product-category.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('product-category.index');
        } catch (\Exception $excep) {
            Alert::error('Error', 'An error occurred while updating the role.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $productCategoryId = Crypt::decrypt($id);
            $data = ProductCategory::findOrFail($productCategoryId);

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('product-category.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('product-category.index');
        }
    }

    public function data()
    {
        $data = ProductCategory::get()
                                ->map(function($productCategory) {
                                    $productCategory->id = Crypt::encrypt($productCategory->id);
                                    
                                    return $productCategory;
                                });

        return DataTables::of($data)
                        ->make(true);
    }
}
