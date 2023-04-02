<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabelFactory extends Factory
{
    protected $model = Label::class;

    public function definition()
    {
        return [
            'packageID' => $this->faker->numberBetween(1, 100),
            'deliverer' => $this->faker->randomElement(['DHL', 'DPD', 'PostNL', 'UPS']),
        ];
    }

    public function forPackage($package)
    {
        return $this->state(function (array $attributes) use ($package) {
            return [
                'packageID' => $package->id,
            ];
        });
    }
}
