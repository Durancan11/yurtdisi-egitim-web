<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 Adet Admin Hesabı 
        User::create([
            'name' => 'Admin Duran Can',
            'email' => 'admin@globalvizyon.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin', // 
            'status' => 'active',
            'balance' => 0.00,
        ]);

        // 5 Adet Örnek Kullanıcı Hesabı 
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Öğrenci Kullanıcı $i",
                'email' => "user$i@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => 'user', // 
                'status' => 'active', // [cite: 53]
                'balance' => 500.00, // Başlangıç bakiyesi [cite: 48]
            ]);
        }
    }
}