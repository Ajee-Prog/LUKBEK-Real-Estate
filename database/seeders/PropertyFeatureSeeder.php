<?php

namespace Database\Seeders;

use App\Models\PropertyFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $features = [

            'Swimming Pool',
            '24/7 Security',
            'CCTV',
            'Generator',
            'Parking',
            'Fitted Kitchen',
            'Garden',
            'Gym',
            'Elevator',
            'Air Conditioning',
            'Internet',
            'Water Supply',
            'Electricity',
            'Boys Quarter',
            'Servant Quarter',

        ];

        foreach ($features as $feature) {

            PropertyFeature::firstOrCreate([
                'name' => $feature
            ]);

        }
    }
}
