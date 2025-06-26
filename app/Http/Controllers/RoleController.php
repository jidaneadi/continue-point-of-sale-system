<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Roles - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.role.index', compact('title'));
    }

    public function create()
    {
        $title = "Roles - Create";

        $permissions = Permission::whereNotIn('name', ['dashboard'])->get();

        return view('master.role.create', compact('title', 'permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            $data = Role::create([
                'name' => strtolower(str_replace(" ", "-", $request->name)),
                'guard_name' => 'web'
            ]);

            $permissions = $request->has('permission') ? $request->permission : [];
            $permissions[] = 'dashboard';

            $data->givePermissionTo($permissions);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('role.index');
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
            $title = "Roles - Edit";

            $roleId = Crypt::decrypt($id);
            $data = Role::findOrFail($roleId);
            $permissions = Permission::whereNotIn('name', ['dashboard'])->get();

            if (strtolower($data->name) === 'administrator') {
                Alert::error('Unauthorized', 'You are not allowed to edit this role.');
                return redirect()->route('role.index');
            }

            return view('master.role.edit', compact('title', 'data', 'permissions'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('role.index');
        }
    }

    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            $data = Role::findOrFail($roleId);

            $data->update([
                'name' => strtolower(str_replace(" ", "-", $request->name))
            ]);

            $permissions = $request->has('permission') ? $request->permission : [];
            $permissions[] = 'dashboard';

            $data->syncPermissions($permissions);
    
            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Alert::error('Error', 'An error occurred while updating the role.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            $data = Role::findOrFail($roleId);

            if (strtolower($data->name) === 'administrator') {
                Alert::error('Unauthorized', 'You are not allowed to delete this role.');
                return redirect()->route('role.index');
            }

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('role.index');
        }
    }

    public function data()
    {
        $data = Role::withCount(['users', 'permissions'])
                    ->get()
                    ->map(function($role) {
                        $role->uuid = Crypt::encrypt($role->uuid);

                        $role->protected = (
                            $role->name === 'administrator'
                        );
                        
                        return $role;
                    });

        return DataTables::of($data)
                        ->editColumn('name', function($item) {
                            $words = explode(" ", str_replace("-", " ", $item->name));

                            $processedWords = array_map(function ($word) {
                                return preg_match('/[aeiou]/i', $word) ? ucwords($word) : strtoupper($word);
                            }, $words);

                            return implode(" ", $processedWords);
                        })
                        ->editColumn('guard_name', function($item) {
                            return ucwords($item->guard_name);
                        })
                        ->addColumn('protected', function($item) {
                            return $item->protected;
                        })
                        ->make(true);
    }
}
