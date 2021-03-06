<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Http\Requests\VehicleRequest;
use Enburn\CarRegistry\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::with('brand.vehicleModels');

        if (!empty($request->get('filterBrandName'))) {
            $vehicles->filterBrandName($request->get('filterBrandName'));
        }

        if (!empty($request->get('filterModelName'))) {
            $vehicles->filterModelName($request->get('filterModelName'));
        }

        return response()->json($vehicles->get());
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
