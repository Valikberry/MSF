<?php

namespace Database\Seeders;


use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Company::truncate();

        $companies = [
            [
                'name' => 'Hayfield Movers',
                'logo' => 'companies/company-1.png',
                'main_service' => 'Van Only',
                'rating' => 4.5,
                'reviews' => 4
            ],
            [
                'name' => 'Valiko Movers',
                'logo' => 'companies/company-2.png',
                'main_service' => 'Van Only',
                'rating' => 4.5,
                'reviews' => 4
            ],
            [
                'name' => 'Dhana Movers',
                'logo' => 'companies/company-2.png',
                'main_service' => 'Van Only',
                'rating' => 4.5,
                'reviews' => 4
            ],
        ];

        foreach ($companies as $company) {
            Company::create( array_merge($company, ['slug' => Str::slug($company['name'])]) );
        }

        $count = Company::count();

        foreach (range(1, $count) as $inc) {
            File::copy(public_path('assets/frontend/images/company-logo.png'), storage_path('app/public/companies/company-'.$inc.'.png'));
        }

        Schema::enableForeignKeyConstraints();
    }

}
