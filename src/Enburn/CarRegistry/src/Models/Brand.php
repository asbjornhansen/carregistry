<?php

namespace Enburn\CarRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'brand_id');
    }

    public function vehicleModels()
    {
        return $this->hasMany(VehicleModel::class, 'brand_id');
    }
}
