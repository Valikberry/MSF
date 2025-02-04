<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class ServiceFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = ['Van Only', 'Driver Only', 'Driver + Van', 'Additional Helpers', 'Moving Boxes', 'Wrapping Materials'];

        return [
            'name' => $services[array_rand($services)],
            'image' => 'services/service.jpg',
            'description' => 'Hi. I am '.fake()->userName.'. I would help you move as you desire. kindly fill the form below so I can know your moving requirements.',
            'is_active' => 1,
        ];
    }




}
