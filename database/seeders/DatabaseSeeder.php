<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    { 
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),  
        ]);
 
        User::create([
            'name' => 'Regular Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
 
        Category::create(['name' => 'Fountain Pens', 'description' => 'Luxury writing instruments.']);
        Category::create(['name' => 'Inks', 'description' => 'Bottled fountain pen inks.']);
        Category::create(['name' => 'Paper', 'description' => 'Fountain pen friendly notebooks.']);
    }
}