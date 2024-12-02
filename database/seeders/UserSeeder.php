<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // insert users 
        $users = [
            [
                'nama' => 'Mahanum',
                'email' => 'owner@example.com',
                'alamat' => 'Jalan Bromo',
                'pekerjaan' => 'bidan',
                'email_verified_at' => now(),
                'no_hp' => '081262225235',
                'tanggal_lahir' => '1961/08/15',
                'status' => 'aktif',
                'role' => 'admin',
                'password' => bcrypt('password'),

            ],
            [
                'nama' => 'Ade',
                'email' => 'bidan1@example.com',
                'alamat' => 'Jalan Bromo',
                'pekerjaan' => 'bidan',
                'no_hp' => '081262225226',
                'tanggal_lahir' => '1995/05/11',
                'status' => 'aktif',
                'email_verified_at' => now(),
                'role' => 'pegawai',
                'password' => bcrypt('password'),

            ],            [
                'nama' => 'Fatimah',
                'email' => 'bidan2@example.com',
                'alamat' => 'Jalan SetiaBudi No. 232',
                'pekerjaan' => 'bidan',
                'no_hp' => '081264346226',
                'tanggal_lahir' => '1997/2/16',
                'status' => 'aktif',
                'email_verified_at' => now(),
                'role' => 'pegawai',
                'password' => bcrypt('password'),
            ],
            [
                'nama' => 'Mayadi',
                'email' => 'mayadi@example.com',
                'alamat' => 'Jalan Gelas',
                'pekerjaan' => 'mahasiswa',
                'no_hp' => '081262225236',
                'tanggal_lahir' => '2005/08/21',
                'email_verified_at' => now(),
                'status' => 'aktif',
                'password' => bcrypt('password'),

            ],

        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }

        User::factory(10)->create();

    }
}