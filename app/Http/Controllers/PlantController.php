<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PlantController extends Controller
{
    public function index()
    {
        $title = "Plant - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.plant.index', compact('title'));
    }

    public function create()
    {
        $title = "Plant - Create";

        return view('master.plant.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => Auth::user()->id,
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
            ];

            $user = Plant::create($data);

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('plant.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding Plant: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while adding the plant.');
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
            $title = "Plant - Edit";

            $plantId = Crypt::decrypt($id);
            $data = Plant::find($plantId);

            return view('master.plant.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('plant.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $plantId = Crypt::decrypt($id);
            $plant = Plant::findOrFail($plantId);

            $data = [
                'user_id' => Auth::user()->id,
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
            ];

            $plant->update($data);

            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('plant.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('plant.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Plant: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while updating the plant.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $plantId = Crypt::decrypt($id);
            Plant::findOrFail($plantId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('plant.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('plant.index');
        }
    }

    public function data()
    {
        $data = Plant::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', 'master.plant.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
