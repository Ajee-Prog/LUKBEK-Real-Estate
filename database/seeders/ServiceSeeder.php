<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{

    public function run()
    {
        $services = [

            [
                'name' => 'Buying & Selling',
                'icon' => 'bi bi-house-check',
                'description' =>
                    'Professional assistance for buying and selling properties.'
            ],

            [
                'name' => 'Estate Management',
                'icon' => 'bi bi-buildings',
                'description' =>
                    'Reliable management of residential and commercial properties.'
            ],

            [
                'name' => 'Real Estate Advisory',
                'icon' => 'bi bi-bar-chart',
                'description' =>
                    'Expert property and investment advisory services.'
            ],

            [
                'name' => 'Interior Decoration',
                'icon' => 'bi bi-lamp',
                'description' =>
                    'Modern interior design and decoration solutions.'
            ],

            [
                'name' => 'Exterior Decoration',
                'icon' => 'bi bi-tree',
                'description' =>
                    'Professional exterior design and property enhancement.'
            ],

            [
                'name' => 'Property Valuation',
                'icon' => 'bi bi-calculator',
                'description' =>
                    'Reliable property valuation and market assessment.'
            ],

        ];

        foreach ($services as $service) {

            Service::updateOrCreate(
                [
                    'slug' =>
                        Str::slug($service['name'])
                ],
                [
                    ...$service,
                    'status' => true
                ]
            );

        }
    }
}
