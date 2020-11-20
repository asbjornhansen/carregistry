<?php

use Enburn\CarRegistry\Http\Controllers\BrandController;
use Enburn\CarRegistry\Http\Controllers\VehicleController;
use Enburn\CarRegistry\Http\Controllers\VehicleModelController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api/v1')->group(function () {
    Route::apiResources([
        'vehicles' => VehicleController::class,
        'brands' => BrandController::class,
        'models' => VehicleModelController::class,
    ]);
});