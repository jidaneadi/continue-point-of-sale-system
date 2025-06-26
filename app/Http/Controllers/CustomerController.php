<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "Customers - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.customer.index', compact('title'));
    }

    public function create()
    {
        $title = "Customers - Create";

        return view('master.customer.create', compact('title'));
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
            ])->assignRole('customer');

            Customer::create([
                'user_id' => $user->id,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('customer.index');
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
            $title = "Customers - Edit";

            $customerId = Crypt::decrypt($id);
            $customer = Customer::findOrFail($customerId);
            $user = User::findOrFail($customer->user_id);

            return view('master.customer.edit', compact('title', 'user', 'customer'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('customer.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $customerId = Crypt::decrypt($id);
            $customer = Customer::findOrFail($customerId);
            $user = User::findOrFail($customer->user_id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('customer.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('customer.index');
        } catch (\Exception $excep) {
            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $customerId = Crypt::decrypt($id);
            $customer = Customer::findOrFail($customerId);
            $user = User::findOrFail($customer->user_id);

            $customer->delete();
            $user->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('customer.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('customer.index');
        }
    }

    public function data()
    {
        $data = Customer::with('user')
                        ->get()
                        ->map(function($customer) {
                            $customer->id = Crypt::encrypt($customer->id);
                                    
                            return $customer;
                        });

        return DataTables::of($data)
                        ->make(true);
    }
}
