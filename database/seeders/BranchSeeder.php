<?php

namespace Database\Seeders;


use App\Models\Branch;
use App\Models\City;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Seeder;
use App\Enums\ServiceMeasureType;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;


class BranchSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Branch::truncate();
        Service::truncate();

        $companies = Company::all();
        $cities = City::all();
        $services = ['Van Only', 'Driver Only', 'Driver + Van', 'Additional Helpers', 'Moving Boxes', 'Wrapping Materials'];

        $i = 1;
        foreach ($companies as $company) {
            foreach ($cities as $city) {
                $data = [
                    "company_id" => $company->id,
                    "city_id" => $city->id,
                    "image" => "branches/dummy-".$i.".jpg",
                    "owner_link" => "https:ownerform/test",
                    "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                    "infolist" => [
                        [
                            "label" => "Name",
                            "value" => "Martell Van Winkleman"
                        ],
                        [
                            "label" => "Company Restricted",
                            "value" => "Martell Movers"
                        ],
                        [
                            "label" => "Model Of Van",
                            "value" => "EJ 9832 8R2"
                        ],
                        [
                            "label" => "Color",
                            "value" => "White"
                        ]
                    ],
                    "contacts" => [
                        [
                            "type" => "phone",
                            "value" => "9860367792"
                        ],
                        [
                            "type" => "website",
                            "value" => "dhankumarlama.com.np"
                        ],
                        [
                            "type" => "address",
                            "value" => "New Baneshwor, Kathmandu"
                        ]
                    ],
                    "availability" => [
                        [
                            "day" => "Sunday",
                            "value" => "6:00AM - 10:00AM"
                        ],
                        [
                            "day" => "Monday",
                            "value" => "6:00AM - 10:00AM"
                        ],
                        [
                            "day" => "Tuesday",
                            "value" => "6:00AM - 10:00AM"
                        ],
                        [
                            "day" => "Wednesday",
                            "value" => "6:00AM - 10:00AM"
                        ],
                        [
                            "day" => "Thursday",
                            "value" => "6:00AM - 10:00AM"
                        ]
                    ],
                    "description" => "<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>",
                ];

                $branch = Branch::create($data);

                $newServices = [];
                foreach ($services as $service) {
                    $newServices[] = [
                        'branch_id' => $branch->id,
                        'name' => $service,
                        'price' => 100,
                        'type' => ServiceMeasureType::hour->name,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                Service::insert($newServices);

                $i++;
            }
        }


        foreach (range(1, $i) as $inc) {
            File::copy(public_path('assets/frontend/images/service.jpg'), storage_path('app/public/branches/dummy-'.$inc.'.jpg'));
        }


        Schema::enableForeignKeyConstraints();
    }

}
