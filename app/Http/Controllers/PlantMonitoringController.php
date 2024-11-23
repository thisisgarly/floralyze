<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\PlantMonitoring;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PlantMonitoringController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        try {
            $title = "Plant Monitoring - Detailed Data";

            $plantId = Crypt::decrypt($id);
            $data = Plant::find($plantId);

            return view('master.plant-monitoring.show', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('plant-monitoring.index');
        }
    }
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function data(string $id)
    {
        try {
            $plantId = Crypt::decrypt($id);
            $data = PlantMonitoring::latest()->where('plant_id', $plantId)->get();

            return DataTables::of($data)
                            ->addIndexColumn()->addColumn('date', function($item) {
                                return Carbon::parse($item->datetime)->format('M d, Y');
                            })
                            ->addColumn('time', function($item) {
                                return Carbon::parse($item->datetime)->format('H:i') . ' WIB';
                            })
                            ->rawColumns(['date', 'time'])
                            ->make(true);
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('plant-monitoring.index');
        }
    }
}
