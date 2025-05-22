<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data pengguna dummy
        $users = [
            [
                'name' => 'joko',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert atau update pengguna (menghindari duplikasi)
        foreach ($users as $user) {
            User::updateOrCreate(
                ['name' => $user['name']], // Kondisi untuk cek duplikasi
                $user // Data untuk insert/update
            );
        }
    }
}