<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role' => 'user',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}