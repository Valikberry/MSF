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
        $this->call([
            AdminSeeder::class,
            SliderSeeder::class,
            SettingSeeder::class,
            CitySeeder::class,
            CompanySeeder::class,
            BranchSeeder::class,
            MovingObjectSeeder::class,
        ]);
    }
}

