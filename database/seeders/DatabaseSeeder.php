<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Category::factory(6)->create();
        $categories = Category::all();
        Product::factory(30)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        User::factory()->create([
            'name' => 'yusuf',
            'email' => 'yusuf@isawi.com',
            'password' => 'password',
            'is_admin' => true
        ]);
    }
}
