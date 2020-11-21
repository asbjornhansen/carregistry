<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Http\Requests\VehicleModelRequest;
use Enburn\CarRegistry\Http\Requests\VehicleRequest;
use Enburn\CarRegistry\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleModelController extends Controller
{
    public function index()
    {
        return response()->json(VehicleModel::all());
    }

    public function store(VehicleModelRequest $request)
    {
        $store = VehicleModel::updateOrCreate(['id' => $request->id], $request->all());

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(VehicleModel $vehicleModel)
    {
        return response()->json($vehicleModel);
    }

    public function update(VehicleModelRequest $request)
    {
        $vehicleModel = VehicleModel::find($request->id);
        $vehicleModel->update($request->all());

        return response()->json($vehicleModel->fresh(), Response::HTTP_CREATED);
    }

    public function destroy(VehicleModel $model)
    {
        $model->delete();

        return response()->json();
    }
}
