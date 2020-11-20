<?php

namespace Enburn\CarRegistry\Configurations;

class FuelTypesConfigration
{
    const GASOLINE = 'Gasoline';
    const DIESEL = 'Diesel';
    const ELECTRICAL = 'Electrical';
    const HYBRID = 'Hybrid';

    public $typesOfFuel = [
        self::GASOLINE,
        self::DIESEL,
        self::ELECTRICAL,
        self::HYBRID,
    ];
}