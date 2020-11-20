<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    public function index()
    {
        return response()->json(Vehicle::all());
    }

    public function store(Request $request)
    {
        $store = Vehicle::updateOrCreate($request->all());

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $update = $vehicle->update($request->all());

        return response()->json($update, Response::HTTP_CREATED);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->softDelete();

        return response();
    }
}
