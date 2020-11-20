<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Enburn\CarRegistry\Http\Requests\BrandRequest;
use Enburn\CarRegistry\Models\Brand;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::all());
    }

    public function store(BrandRequest $request)
    {
        $store = Brand::updateOrCreate($request->all());

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(Brand $brand)
    {
        return response()->json($brand);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $update = $brand->update($request->all());

        return response()->json($update, Response::HTTP_CREATED);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response();
    }
}