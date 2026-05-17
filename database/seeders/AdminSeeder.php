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
            ['email' => 'admin@carapp.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'user@carapp.com'],
            [
                'name'     => 'User',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );

        $this->command->info('Admin account created: admin@carapp.com / password');
        $this->command->info('User account created: user@carapp.com / password');
    }
}
