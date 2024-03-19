<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'scientific_name' => $this->faker->word,
            'season' => $this->faker->randomElement(['spring', 'summer', 'autum', 'winter']),
            'description' => $this->faker->sentence,
            'unit_price' => $this->faker->randomFloat(2, 1, 100),
            'img_path' => $this->faker->imageUrl(),
        ];
    }
}
