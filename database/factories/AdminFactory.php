<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'username' => fake()->userName,
            'password' => fake()->password,
            'image' => fake()->imageUrl,
            'role_id' =>fake()->numberBetween(1,6),
            'email'=>fake()->email,
            'email_verified_at'=> null,
            'remember_token' =>null
        ];
    }
}
