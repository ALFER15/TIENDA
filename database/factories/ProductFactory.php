<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name'=> fake()->lastName(),
            'stock'=> fake()->randomNumber(5, false),
            'store_price'=> fake()->randomFloat(2),
            'public_price'=> fake()->randomFloat(2),
            'expiration'=> fake()->dateTimeBetween('-1 week', '+1 week'),
            'assortment'=> fake()->dateTimeBetween('-1 week', '+3 week'),
            'status'=> fake()->randomElement(['active', 'disable']),
            'supplier_id'=> fake()->numberBetween(1, 10),
            'category_id'=> fake()->numberBetween(1, 4),
        ];
    }
}
