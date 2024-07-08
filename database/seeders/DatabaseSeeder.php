<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\PropertyPicture;
use App\Models\PropertyType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedRoles();
        $this->seedPropertyTypes();
        $this->seedUsers();
        $this->seedProperties();
        $this->seedPropertyPictures();
    }

    private function seedPropertyTypes(): void
    {
        $propertyTypes = ["House", "Apartment", "Building", "Office"];
        foreach ($propertyTypes as $type) {
            PropertyType::create(['name' => $type]);
        }
    }

    private function seedUsers(): void
    {
        $sellerRole = Role::firstWhere('name', UserRole::SELLER->value);
        $userRole = Role::firstWhere('name', UserRole::USER->value);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole(Role::firstWhere('name', UserRole::ADMIN->value));

        User::factory()->count(10)->create()->each(
            fn (User $user) => $user->assignRole($sellerRole)
        );
        User::factory()->count(20)->create()->each(
            fn (User $user) => $user->assignRole($userRole)
        );
    }

    private function seedProperties(): void
    {
        $userIds = User::pluck('id')->toArray();
        $propertyTypeIds = PropertyType::pluck('id')->toArray();

        \App\Models\Property::factory()->count(10)->make()->each(function ($property) use ($userIds, $propertyTypeIds) {
            $property->user_id = $this->getRandomId($userIds);
            $property->property_type_id = $this->getRandomId($propertyTypeIds);
            $property->save();
        });
    }

    private function seedPropertyPictures(): void
    {
        $properties = \App\Models\Property::all();

        foreach ($properties as $property) {
            $this->createPropertyPictures($property);
        }
    }

    private function getRandomId(array $ids): int
    {
        return $ids[array_rand($ids)];
    }

    private function createPropertyPictures(\App\Models\Property $property): void
    {
        $numberOfPictures = rand(3, 8);

        for ($i = 0; $i < $numberOfPictures; $i++) {
            PropertyPicture::factory()->create([
                'property_id' => $property->id,
                'title' => "Image {$i} of {$property->name}",
                'description' => "A beautiful view of property {$property->name}",
                'is_primary' => $i === 0, // First image is primary
                'display_order' => $i,
            ]);
        }
    }

    private function seedRoles(){
        foreach (UserRole::cases() as $role){
            Role::create([
                'name' => $role->value,
            ]);
        }

        (Permission::create([
            'name' => 'property-*'
        ]))->assignRole(
            Role::firstWhere('name', UserRole::SELLER->value)
        );
    }

}
