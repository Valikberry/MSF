<?php

namespace Database\Seeders;


use App\Enums\Currency;
use App\Models\Admin;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Outerweb\Settings\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Setting::truncate();

        $footerLinks = [["link" => "/aboutus.html","name" => "About"],["link" => "/Contacts.html","name" => "Contacts"],["link" => "/Blog.html","name" => "Blog"],["link" => "/Privacy.html","name" => "Privacy"],["link" => "/Terms.html","name" => "Terms"]];
        $socialLinks = [["icon" => "fa-linkedin","link" => "https://linkedin.com/profile"],["icon" => "fa-facebook","link" => "https://facebook.com/profile"],["icon" => "fa-youtube","link" => "https://youtube.com/profile"],["icon" => "fa-pinterest","link" => "https://pinterest.com/profile"]];

        $settings = [
            [
                'key' => 'company_name',
                'value' => "Moving Service",
            ],
            [
                'key' => 'company_logo',
                'value' => "settings/logo.png",
            ],
            [
                'key' => 'currency',
                'value' => Currency::euro->name,
            ],
            [
                'key' => 'terms_page_link',
                'value' => 'terms.com',
            ],
            [
                'key' => 'consent_page_link',
                'value' => 'consent.com',
            ],
            [
                'key' => 'footer_content',
                'value' => "<p>Call out customer care number: <a href=\"tel:+358417217972\">+358 41 7217 972</a></p><p>You may reach us at <a href=\"mailto:support@gmail.com\">support@gmail.com</a></p><p>We serve Mon-Fri, 9AM-8PM</p>",
            ],
            [
                'key' => 'country_flag',
                'value' => '<svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 841.05 586.08"><g fill-rule="nonzero"><path fill="#fff" d="M839.41 47.68V538.4c0 25.33-20.72 46.05-46.04 46.05H47.68c-22.51 0-41.38-16.38-45.3-37.81V39.44c3.92-21.43 22.79-37.8 45.3-37.8h745.69c25.32 0 46.04 20.72 46.04 46.04z"/><path fill="#003580" d="M1.64 236.17h837.77v89.41H1.64z"/><path fill="#003580" d="M240.04 1.64v582.81h-89.41V1.64z"/></g><rect fill="none" stroke="#CCC" stroke-width="3.27" stroke-miterlimit="22.926" x="1.64" y="1.63" width="837.77" height="582.81" rx="44.53" ry="46.04"/></svg>',
            ],
            [
                'key' => 'phone_code',
                'value' => "+358",
            ],
            [
                'key' => 'footer_links',
                'value' => $footerLinks,
            ],
            [
                'key' => 'social_links',
                'value' => $socialLinks,
            ],


            [
                'key' => 'site_author',
                'value' => 'John Doe',
            ],
            [
                'key' => 'meta_title',
                'value' => 'Moving Service Finland',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Best moving service in finland, best mover professional in cities of finland',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'Profession, Mover, Finland, Cities',
            ],


            [
                'key' => 'admin_sheet_id',
                'value' => config('services.google_sheet.admin_sheet_id'),
            ],
            [
                'key' => 'admin_sheet_name',
                'value' => 'Sheet1',
            ],
            [
                'key' => 'sales_sheet_id',
                'value' => config('services.google_sheet.sales_sheet_id'),
            ],
            [
                'key' => 'sales_sheet_name',
                'value' => 'Sheet1',
            ],
            [
                'key' => 'contact_sheet_id',
                'value' => config('services.google_sheet.contact_sheet_id'),
            ],
            [
                'key' => 'contact_sheet_name',
                'value' => 'Sheet1',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        File::copy(public_path('assets/frontend/images/logo.png'), storage_path('app/public/settings/logo.png'));

        Schema::enableForeignKeyConstraints();
    }

}
