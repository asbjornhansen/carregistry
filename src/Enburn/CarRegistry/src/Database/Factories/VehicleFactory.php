<?php

namespace Enburn\CarRegistry\Database\Factories;

use Carbon\Carbon;
use Enburn\CarRegistry\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $manufactoryDate = Carbon::parse($this->faker->dateTimeThisCentury);

        return [
            'plate_number' => $this->faker->lexify('??') . $this->faker->randomNumber(5),
            'model' => 'S-max TDI 2.0 2006-2010',
            'year' => $manufactoryDate,
            'mileage' => $this->faker->randomNumber(6),
            'registered_at' => $manufactoryDate->addDays($this->faker->randomDigit(365)),
            'veteran_status' => (int) $manufactoryDate->age >= 30,
        ];
    }
}
