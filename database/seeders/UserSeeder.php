<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        User::create(['name' => 'Admin User', 'email' => 'admin@test.com', 'password' => $password, 'role' => 'admin', 'is_active' => true, 'email_verified_at' => now(), 'img_path' => 'profile_photos/default_user.png']);
        User::create(['name' => 'Regular Customer', 'email' => 'customer@test.com', 'password' => $password, 'role' => 'customer', 'is_active' => true, 'email_verified_at' => now()]);

        $names = ['Arthur Pendragon', 'Diana Prince', 'Bruce Wayne', 'Clark Kent', 'Tony Stark', 'Peter Parker', 'Natasha Romanoff', 'Steve Rogers'];
        foreach ($names as $index => $name) {
            User::create([
                'name' => $name,
                'email' => 'customer' . ($index + 2) . '@test.com',
                'password' => $password,
                'role' => 'customer',
                'is_active' => true,
                'email_verified_at' => now()->subDays(rand(1, 30)),
                'img_path' => 'profile_photos/default_user.png'
            ]);
        }
    }
}