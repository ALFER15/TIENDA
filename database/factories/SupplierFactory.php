<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rfc'=>fake()->unique()->md5(),
            'name'=>fake()->name(),
            'phone'=>12345,
            'email'=>fake()->email(),
            'manager_name'=>fake()->name(),
            'address'=>fake()->streetAddress(),
        ];
    }
}
