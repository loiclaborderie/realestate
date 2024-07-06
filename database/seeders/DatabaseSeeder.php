<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ["admin", "seller", "buyer"];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        User::factory()->admin()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->seller()->createMany(10);

        User::factory()->createMany(20);
    }
}
