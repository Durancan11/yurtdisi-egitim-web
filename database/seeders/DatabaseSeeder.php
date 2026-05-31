<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Önceki deneme verilerini temizlemek ve 
        // UserSeeder ile ProductSeeder'ı sisteme yüklemek için:
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}