<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'labelID' => null,
            'pickupID' => null,
            'trackandtracecode' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'status' => $this->faker->randomElement(['Submitted', 'Label printed', 'Delivered to warehouse', 'In sorting centre', 'On its way', 'Delivered to customer']),
            'dimensions' => $this->faker->randomFloat(2, 1, 100) . 'x' . $this->faker->randomFloat(2, 1, 100) . 'x' . $this->faker->randomFloat(2, 1, 100),
            'weight' => $this->faker->randomFloat(2, 0.1, 50),
            'webshopName' => $this->faker->company(),
            'webshopStreet' => $this->faker->streetName(),
            'webshopHousenumber' => $this->faker->buildingNumber(),
            'webshopZipcode' => $this->faker->postcode(),
            'webshopCity' => $this->faker->city(),
            'customerEmail' => $this->faker->email(),
            'customerName' => $this->faker->name(),
            'customerStreet' => $this->faker->streetName(),
            'customerHousenumber' => $this->faker->buildingNumber(),
            'customerZipcode' => $this->faker->postcode(),
            'customerCity' => $this->faker->city(),
        ];
    }
}
