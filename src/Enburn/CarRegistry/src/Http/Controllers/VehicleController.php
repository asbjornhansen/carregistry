<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Http\Requests\VehicleRequest;
use Enburn\CarRegistry\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    public function index()
    {
        return response()->json(Vehicle::with('brand.vehicleModels')->get());
    }

    public function store(VehicleRequest $request)
    {
        $store = Vehicle::updateOrCreate(['id' => $request->get('id')], $request->all());

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        return response()->json($vehicle->fresh(), Response::HTTP_CREATED);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->json();
    }
}
