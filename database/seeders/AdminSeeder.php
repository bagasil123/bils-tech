<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bilstech.id'],
            [
                'name'     => 'Bagas Admin',
                'email'    => 'admin@bilstech.id',
                'password' => Hash::make('password'),
            ]
        );
    }
}
