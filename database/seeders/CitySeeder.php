<?php

namespace Database\Seeders;


use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        City::truncate();

        $cities = ['Helsinki', 'Vantaa', 'Oulu', 'Jyväskylä', 'Pori', 'Nokia', 'Espoo', 'Tampere', 'Turku', 'Rovaniemi'];

        foreach ($cities as $city) {
            City::create(['name' => $city, 'slug' => Str::slug($city)]);
        }

        Schema::enableForeignKeyConstraints();
    }

}
