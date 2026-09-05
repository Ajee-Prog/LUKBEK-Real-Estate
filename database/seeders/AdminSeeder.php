<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@lukbek.com'
            ],
            [
                'name' => 'LUKBEK Super Admin',

                'password' =>
                    Hash::make('password'),

                'role' => 'super_admin',
            ]
        );
    }
}
