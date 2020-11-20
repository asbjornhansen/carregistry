<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Http\Requests\VehicleRequest;
use Enburn\CarRegistry\Models\VehicleModel;
use Illuminate\Http\Response;

class VehicleModelController extends Controller
{
    public function index()
    {
        return response()->json(VehicleModel::all());
    }

    public function store(VehicleRequest $request)
    {
        $store = VehicleModel::updateOrCreate($request->all());

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(VehicleModel $vehicleModel)
    {
        return response()->json($vehicleModel);
    }

    public function update(VehicleRequest $request, VehicleModel $vehicleModel)
    {
        $update = $vehicleModel->update($request->all());

        return response()->json($update, Response::HTTP_CREATED);
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->softDelete();

        return response();
    }
}
