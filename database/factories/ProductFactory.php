<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
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
            'name' => $this->faker->unique()->words(3, true),
            'brief_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'old_price' => $this->faker->randomFloat(2, 1, 1000),
            'SKU' => $this->faker->unique()->bothify('SKU-####'),
            'stock_status' => $this->faker->randomElement(['instock', 'outstock']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(),
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
        ];
    }
}
