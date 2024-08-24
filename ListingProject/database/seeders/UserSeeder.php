<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$12$j3ZtQ6sdOwVcl7ej0iMeYe4UxaObr8i9WTL8mDwqWo3fUAWuUGtJq', // password
                'user_type' => 'admin'
            ],
            [
                'name' => 'Jhone deo',
                'email' => 'user@gmail.com',
                'password' => '$2y$12$j3ZtQ6sdOwVcl7ej0iMeYe4UxaObr8i9WTL8mDwqWo3fUAWuUGtJq', // password
                'user_type' => 'user'
            ]
        ]);

        // assign super admin role to the admin user
        // $user = User::where('email', 'admin@gmail.com')->first();
        // $user->assignRole('Super Admin');
    }
}
