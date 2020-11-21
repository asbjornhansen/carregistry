<?php

namespace Enburn\CarRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'number_of_seats',
        'fuel_type',
    ];

    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'vehicle_id', 'id');
    }
}
