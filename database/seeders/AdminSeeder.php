<?php

namespace Database\Seeders;


use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Admin::truncate();
        Admin::create([
            'name' => 'Dhan Kumar Lama',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_active' => 1,
        ]);

        Schema::enableForeignKeyConstraints();
    }

}
