<?php

namespace Enburn\CarRegistry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization is done in middleware in reality. No authorization in this sample project
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }

}