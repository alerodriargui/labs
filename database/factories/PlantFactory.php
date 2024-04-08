<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PlantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'scientific_name' => fake()->name(),
            'season' => fake()->randomElement(['spring', 'summer', 'autum', 'winter']),
            'description' => fake()->sentence(),
            'unit_price' => fake()->randomFloat(2, 1, 100),
            'img_path' => fake()->imageUrl(),
        ];
    }
}
