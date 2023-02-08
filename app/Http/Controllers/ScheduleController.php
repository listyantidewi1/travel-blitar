<?php

namespace App\Http\Controllers;

use App\Models\ScheduleModel;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function createschedule(Request $request)
    {
        try {
            // dd($request->except('token'));
            $query = ScheduleModel::create($request->except('token'));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data cannot be processed',
                "err" => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => "create success",
        ], 200);
    }
}
