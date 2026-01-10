<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Inksiders',
            'email' => 'admin@inksiders.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        // Create Test User
        User::create([
            'name' => 'Test User',
            'email' => 'test@inksiders.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('Users created successfully!');
        $this->command->info('Email: admin@inksiders.com | Password: password123');
        $this->command->info('Email: test@inksiders.com | Password: password123');
    }
}