<?php

namespace Enburn\CarRegistry\Database\Factories;

use Enburn\CarRegistry\Configurations\FuelTypesConfigration;
use Enburn\CarRegistry\Models\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'S-max TDI 2.0 2006-2010',
            'number_of_seats' => $this->faker->randomElement([2,5]),
            'fuel_type' => $this->faker->randomElement(app(FuelTypesConfigration::class)->typesOfFuel),
        ];
    }
}
