<?php

namespace Enburn\CarRegistry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization is done in middleware in reality. No authorization in this sample project
    }

    public function rules()
    {
        return [
            'plate_number' => 'required|regex:/[a-zA-Z]{2}\d{5}$/',
            'model' => 'required|string',
            'year' => 'required|date',
            'mileage' => 'required|numeric',
            'registered_at' => 'required|date',
            'veteran_status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'plate_number.regex' => 'The number plate must begin with two letters followed by five numbers.',
        ];
    }
}
