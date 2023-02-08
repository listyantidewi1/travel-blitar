<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Models\PlaceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{
    public function allplace(Request $request)
    {

        $alldata = PlaceModel::all();

        return response()->json([
            'data' => $alldata,
        ], 200);
    }

    public function createplace(Request $request)
    {

        try {
            $query = PlaceModel::create([
                'name' => $request->nama,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image-path' => $request->imagePath,
                'description' => $request->description
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Data cannot be processed',
            ], 422);
        }

        return response()->json([
            'message' => "create success",
        ], 200);
    }

    public function deleteplace($id)
    {
        try {
            // findOrFail digunakan mencari id, jika gagal di cari maka masuk ke catch
            PlaceModel::findOrFail($id)->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => "Data cannot be deleted",
            ], 400);
        }

        return response()->json([
            'message' => "delete success",
        ], 200);
    }

    public function updateplace(Request $request, $id)
    {
        try {
            PlaceModel::findOrFail($id)->update($request->except("token"));
        } catch (Exception $e) {
            return response()->json([
                'message' => "Data cannot be updated",
            ], 400);
        }

        return response()->json([
            'message' => "update success",
        ], 200);
    }

    public function findplace($id)
    {
        $find = collect(PlaceModel::find($id))->except('created_at', 'updated_at');
        return response()->json([
            'data' => $find
        ], 200);
    }
}
