<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sergio@gmail.com'],
            [
                'name' => 'Sergio',
                'password' => Hash::make('2026Admin#'),
                'is_admin' => true,
            ],
        );
    }
}
