<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::insert([
            [
                'name'=> 'category 1',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
             [
                'name'=> 'category 2',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
