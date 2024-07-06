<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ["admin", "seller", "buyer"];
        $property_types = ["House", "Appartment", "Building", "Office"];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        foreach ($property_types as $type) {
            PropertyType::create(['name' => $type]);
        }

        $me = User::factory()->admin()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->seller()->createMany(10);

        User::factory()->createMany(20);

        $user_ids = User::all()->pluck('id')->toArray();
        $property_type_ids = PropertyType::all()->pluck('id')->toArray();

        \App\Models\Property::factory()->count(10)->make()->each(function ($property) use ($user_ids, $property_type_ids) {
            $property->user_id = $user_ids[array_rand($user_ids)];
            $property->property_type_id = $property_type_ids[array_rand($property_type_ids)];
            $property->save();
        });
    }
}
