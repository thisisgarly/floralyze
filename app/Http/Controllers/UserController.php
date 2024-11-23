<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $title = "User - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.user.index', compact('title'));
    }

    public function create()
    {
        $title = "User - Create";
        $roles = Role::get();

        return view('master.user.create', compact('title', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $gender = $request->gender == 'male' ? true : false;

            $data = [
                'name' => $request->name,
                'gender' => $gender,
                'status' => $request->status,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = User::create($data);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('user.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding User: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while adding the user.');
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
            $title = "User - Edit";

            $userId = Crypt::decrypt($id);
            $data = User::find($userId);

            return view('master.user.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('user.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            $user = User::findOrFail($userId);

            $gender = $request->gender == 'male' ? true : false;

            $data = [
                'name' => $request->name,
                'gender' => $gender,
                'status' => $request->status,
                'email' => $request->email,
            ];

            $user->update($data);
    
            if ($request->has('role')) {
                $user->syncRoles($request->role);
            }

            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('user.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('user.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating User: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while updating the user.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            User::findOrFail($userId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('user.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('user.index');
        }
    }

    public function data()
    {
        $data = User::with('roles')
                    ->orderBy('name', 'asc')
                    ->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('roles', function ($item) {
                            return ucwords($item->roles->pluck('name')->implode(', '));
                        })
                        ->editColumn('gender', function ($item) {
                            return $item->gender ? 'Male' : 'Female';
                        })
                        ->addColumn('action', 'master.user.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
