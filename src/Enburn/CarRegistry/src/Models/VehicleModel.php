<?php

namespace Enburn\CarRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'vehicle_id', 'id');
    }
}
