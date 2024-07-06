<?php

namespace Database\Factories;

use App\Models\PropertyPicture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyPictureFactory extends Factory
{
    protected $model = PropertyPicture::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(),
            'title' => rand(0,1) === 1 ? $this->faker->words(2) : null,
            'description' => rand(0,1) === 1 ? $this->faker->text() : null,
            'is_primary' => rand(0,1) === 1 ? $this->faker->boolean() : null,
            'display_order' => rand(0,1) === 1 ? $this->faker->numberBetween(1, 5) : null,
        ];
    }
}
