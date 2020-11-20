<?php

namespace Enburn\CarRegistry\Database\Factories;

use Enburn\CarRegistry\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Toyota', 'Lexus', 'Tesla', 'Volvo', 'Polestar']),
        ];
    }
}
