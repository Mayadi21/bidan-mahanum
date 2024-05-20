<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'bio' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Aku Manusia',
            'username' => 'akumanusia',
            'bio' => 'Aku Manusia',
            'email' => 'akumanusia@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('akumanusia'),
            'role' => 'user',
        ]);

        User::factory(10)->create();
    }
}
