<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'street' => $this->faker->streetName(),
            'housenumber' => $this->faker->buildingNumber(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'api_token' => 'test_token',
        ];
    }

    public function forRole($role)
    {
        return $this->state(function (array $attributes) use ($role) {
            return [
                'role' => $role,
                'api_token' => 'test_token',
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
