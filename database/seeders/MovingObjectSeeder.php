<?php

namespace Database\Seeders;


use App\Models\MovingItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MovingObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        MovingItem::truncate();

        $objects = ['Studio', '1 Bedroom', '2 Bedroom', '3+ Bedroom', 'House', 'Warehouse Moving', 'Elevator', 'Stairs', 'Office or Commercial', 'Other (please specify)'];
        foreach ($objects as $object) {
            MovingItem::create(['name' => $object]);
        }

        Schema::enableForeignKeyConstraints();
    }

}
