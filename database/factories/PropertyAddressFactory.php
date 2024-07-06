<?php

namespace Database\Factories;

use App\Models\PropertyAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyAddressFactory extends Factory
{
    protected $model = PropertyAddress::class;

    public function definition(): array
    {
        return [
            'country' => $this->faker->country(),
            'state' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'zip' => $this->faker->postcode(),
            'unit_number' => rand(0,1) === 1 ? $this->faker->buildingNumber() : null,
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
