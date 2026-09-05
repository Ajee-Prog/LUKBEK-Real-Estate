<?php

namespace Database\Seeders;

use App\Models\PropertyCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'House',
            'Apartment',
            'Duplex',
            'Land',
            'Commercial Property',
            'Office',
            'Shop',
            'Warehouse',
            'Hotel',
            'Shortlet',
            'Estate',
        ];

        foreach ($categories as $name) {

            PropertyCategory::updateOrCreate(
                [
                    'slug' => Str::slug($name)
                ],
                [
                    'name' => $name,
                    'status' => true,
                ]
            );

        }
    }
}
