<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->ean8(),
            'name' => 'product - ' . $this->faker->words(5, true),
            'description' => $this->faker->text(),
            'price' => (int) $this->faker->randomFloat(2, 10, 100),
            'quantity' => (int) $this->faker->randomFloat(2, 10, 100),
        ];
    }
}