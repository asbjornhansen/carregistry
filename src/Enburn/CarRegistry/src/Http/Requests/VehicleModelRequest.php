<?php

namespace Enburn\CarRegistry\Http\Requests;

use Enburn\CarRegistry\Configurations\FuelTypesConfigration;
use Illuminate\Foundation\Http\FormRequest;

class VehicleModelRequest extends FormRequest
{
    public function authorized()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'sometimes|exists:vehicle_models',
            'name' => 'required|string',
            'number_of_seats' => 'required|numeric',
            'fuel_type' => 'required|in:' . implode(',', app(FuelTypesConfigration::class)->typesOfFuel),
        ];
    }
}
