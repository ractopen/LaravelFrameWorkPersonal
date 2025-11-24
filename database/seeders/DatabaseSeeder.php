<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@buymyclassmate.inc', // Random hash email effectively
            'password' => Hash::make('admin'),
            'is_admin' => true,
        ]);
    }
}
