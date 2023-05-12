<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cat_name = $this->faker->unique()->words(2, true);
        $cat_slug = Str::slug($cat_name);
        return [
            'name' => $cat_name,
            'slug' => $cat_slug,
        ];
    }
}
