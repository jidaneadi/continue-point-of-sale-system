<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCashierRequest;
use App\Models\Cashier;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CashierController extends Controller
{
    public function index()
    {
        $title = "Cashiers - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.cashier.index', compact('title'));
    }

    public function create()
    {
        $title = "Cashiers - Create";

        return view('master.cashier.create', compact('title'));
    }

    public function store(StoreCashierRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
            ])->assignRole('cashier');

            Cashier::create([
                'user_id' => $user->id,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('cashier.index');
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
            $title = "Cashiers - Edit";

            $cashierId = Crypt::decrypt($id);
            $cashier = Cashier::findOrFail($cashierId);
            $user = User::findOrFail($cashier->user_id);

            return view('master.cashier.edit', compact('title', 'user', 'cashier'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('cashier.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $cashierId = Crypt::decrypt($id);
            $cashier = Cashier::findOrFail($cashierId);
            $user = User::findOrFail($cashier->user_id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('cashier.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('cashier.index');
        } catch (\Exception $excep) {
            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $cashierId = Crypt::decrypt($id);
            $cashier = Cashier::findOrFail($cashierId);
            $user = User::findOrFail($cashier->user_id);

            $cashier->delete();
            $user->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('cashier.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('cashier.index');
        }
    }

    public function data()
    {
        $data = Cashier::with('user')
                        ->get()
                        ->map(function($cashier) {
                            $cashier->id = Crypt::encrypt($cashier->id);
                                    
                            return $cashier;
                        });

        return DataTables::of($data)
                        ->make(true);
    }
}
