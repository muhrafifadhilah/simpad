<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UptSeeder::class,
            SubjekPajakSeeder::class,
            ObjekPajakSeeder::class,
            SptpdSeeder::class,
            UserSeeder::class
        ]);
    }
}
