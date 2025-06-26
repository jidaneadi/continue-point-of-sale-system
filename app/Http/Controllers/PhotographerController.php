<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotographerRequest;
use App\Models\Photographer;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PhotographerController extends Controller
{
    public function index()
    {
        $title = "Photographers - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.photographer.index', compact('title'));
    }

    public function create()
    {
        $title = "Photographers - Create";

        return view('master.photographer.create', compact('title'));
    }

    public function store(StorePhotographerRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
            ])->assignRole('photographer');

            Photographer::create([
                'user_id' => $user->id,
                'type' => $request->type,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('photographer.index');
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
            $title = "Photographers - Edit";

            $photographerId = Crypt::decrypt($id);
            $photographer = Photographer::findOrFail($photographerId);
            $user = User::findOrFail($photographer->user_id);

            return view('master.photographer.edit', compact('title', 'user', 'photographer'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photographer.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $photographerId = Crypt::decrypt($id);
            $photographer = Photographer::findOrFail($photographerId);
            $user = User::findOrFail($photographer->user_id);

            $photographer->update([
                'type' => $request->type,
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('photographer.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photographer.index');
        } catch (\Exception $excep) {
            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $photographerId = Crypt::decrypt($id);
            $photographer = Photographer::findOrFail($photographerId);
            $user = User::findOrFail($photographer->user_id);

            $photographer->delete();
            $user->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('photographer.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photographer.index');
        }
    }

    public function data()
    {
        $data = Photographer::with('user')
                        ->get()
                        ->map(function($photographer) {
                            $photographer->id = Crypt::encrypt($photographer->id);
                                    
                            return $photographer;
                        });

        return DataTables::of($data)
                        ->editColumn('type', function($item) {
                            return $item->type ? 'Indoor' : 'Outdoor';
                        })
                        ->make(true);
    }
}
