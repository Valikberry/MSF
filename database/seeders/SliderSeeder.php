<?php

namespace Database\Seeders;


use App\Models\Admin;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Slider::truncate();

        $sliders = [
            [
                'name' => 'This is slider 1',
                'description' => 'Hi. I am xxxxxxx. I would help you move as you desire. Kindly fill the form below so I can know your moving requirements.',
                'image' => 'banners/pro.png',
                'is_active' => 1,
            ],
            [
                'name' => 'This is slider 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem a aliquid ipsa amet expedita, voluptatum eum',
                'image' => 'banners/pro.png',
                'is_active' => 1,
            ],
            [
                'name' => 'This is slider 3',
                'description' => 'Hi. I am xxxxxxx. I would help you move as you desire. Kindly fill the form below so I can know your moving requirements.',
                'image' => 'banners/pro.png',
                'is_active' => 1,
            ],
        ];

        $i = 1;
        foreach ($sliders as $slider) {
            Slider::create(array_merge($slider, ['sort_order' => $i++]));
        }

        File::copy(public_path('assets/frontend/images/pro.png'), storage_path('app/public/banners/pro.png'));

        Schema::enableForeignKeyConstraints();
    }

}
