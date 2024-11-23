<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Role - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.role.index', compact('title'));
    }

    public function create()
    {
        $title = "Role - Create";

        return view('master.role.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding Role: ' . $excep->getMessage());
        
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
            $title = "Role - Edit";

            $userId = Crypt::decrypt($id);
            $data = Role::find($userId);

            return view('master.role.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            $role = Role::findOrFail($roleId);

            $role->update([
                'name' => $request->name
            ]);
    
            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Role: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while updating the role.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            Role::findOrFail($roleId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        }
    }

    public function data()
    {
        $data = Role::latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', 'master.role.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
