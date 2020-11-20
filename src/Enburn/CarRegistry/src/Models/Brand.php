<?php

namespace Enburn\CarRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicleModels()
    {
        return $this->hasMany(VehicleModel::class, 'vehicle_id', 'id');
    }
}
