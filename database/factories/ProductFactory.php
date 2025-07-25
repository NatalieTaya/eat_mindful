<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->unique()->sentence(3),
            'protein'=>fake()->numberBetween(0,100),
            'fats'=>fake()->numberBetween(0,100),
            'carbs'=>fake()->numberBetween(0,100),
            'kkal'=>fake()->numberBetween(0,100),
            'fibre'=>fake()->numberBetween(0,100)
        ];
    }
}
