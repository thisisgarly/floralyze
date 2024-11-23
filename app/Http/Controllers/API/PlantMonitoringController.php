<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlantMonitoringResource;
use App\Models\Plant;
use App\Models\PlantMonitoring;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlantMonitoringController extends Controller
{
    public function store(Request $request)
    {
        try {
            $Validator = Validator::make($request->all(), [
                'code' => 'required',
                'temperature'   => 'required',
                'humidity'   => 'required',
            ]);
    

            if ($Validator->fails()) {
                return response()->json($Validator->errors(), 422);
            }

            $plant = Plant::where('code', $request->code)->get()->first();

            if ($plant != NULL) {
                $platMonitoring = PlantMonitoring::create([
                    'plant_id' => $plant->id,
                    'temperature' => $request->temperature,
                    'humidity' => $request->humidity,
                    'date' => Carbon::now(),
                ]);
            }

            return new PlantMonitoringResource(true, 'You\'ve Successfully Registered', $platMonitoring);
        } catch (Exception $excep) {
            return new PlantMonitoringResource(false, 'Error', $excep);
        }
    }
}
