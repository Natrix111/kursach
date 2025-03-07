<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password123'),
            'email_verify' => 1
        ]);

        User::create([
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
            'email_verify' => 1
        ]);

        User::create([
            'username' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password123'),
            'email_verify' => 1
        ]);
    }
}
