<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  config('data.categories');

        foreach ($data as $key => $item) {
            Categories::create([
                'brand_id' => $item['brand_id'],
                'name' => $item['name']
            ]);
        }
    }
}
