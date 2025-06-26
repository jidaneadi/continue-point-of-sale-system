<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoSessionRequest;
use App\Http\Requests\UpdatePhotoSessionRequest;
use App\Models\PhotoSession;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class PhotoSessionController extends Controller
{
    public function index()
    {
        $title = "Sessions - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.photo-session.index', compact('title'));
    }

    public function create()
    {
        $title = "Sessions - Create";

        return view('master.photo-session.create', compact('title'));
    }

    public function store(StorePhotoSessionRequest $request)
    {
        try {
            $data = PhotoSession::create([
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            Alert::success('Congrats', 'You\'ve successfully created data');
            return redirect()->route('photo-session.index');
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
            $title = "Sessions - Edit";

            $sessionId = Crypt::decrypt($id);
            $data = PhotoSession::findOrFail($sessionId);

            return view('master.photo-session.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photo-session.index');
        }
    }

    public function update(UpdatePhotoSessionRequest $request, string $id)
    {
        try {
            $sessionId = Crypt::decrypt($id);
            $data = PhotoSession::findOrFail($sessionId);

            $data->update([
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            Alert::success('Congrats', 'You\'ve successfully updated');
            return redirect()->route('photo-session.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photo-session.index');
        } catch (\Exception $excep) {
            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $categoryId = Crypt::decrypt($id);
            $data = PhotoSession::findOrFail($categoryId);

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('photo-session.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('photo-session.index');
        }
    }

    public function data(): JsonResponse
    {
        $data = PhotoSession::get()
                            ->map(function ($photoSession) {
                                $photoSession->id = Crypt::encrypt($photoSession->id);

                                return $photoSession;
                            });

        return DataTables::of($data)->make(true);
    }
}
