<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyAddress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    protected $propertyNouns = ['House', 'Appartment', 'Villa', 'Castle', 'Squat'];

    public function definition(): array
    {
        return [
            'name'=> $this->propertyNouns[rand(0, count($this->propertyNouns)-1)] . ' ' . $this->faker->word(),
            'price' => $this->faker->numberBetween(5000, 1000000),
            'bedroom' => $this->faker->numberBetween(1, 5),
            'bathroom' => $this->faker->numberBetween(1, 3),
            'floor' => $this->faker->numberBetween(1, 3),
            'building_area' => $this->faker->numberBetween(12, 300),
            'land_area' => $this->faker->numberBetween(1, 100),
            'sold_at' => rand(0,1) === 1 ? Carbon::now() : null,
            'property_address_id' => PropertyAddress::factory(),
        ];
    }
}
