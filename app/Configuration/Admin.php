<?php

namespace App\Configuration;

use App\Enums\ContactType;

class Admin
{
    //Service Image
    public static function getCompanyMediaDirectory(?string $folder = null): string
    {
        return config('admin.company_media_folder').($folder ? DIRECTORY_SEPARATOR.$folder : '');
    }

    public static function getCompanyMediaDisk(): string
    {
        return (string) config('admin.company_media_disk') ?? 'public';
    }

    public static function getCompanyMediaMaxSize(): int
    {
        return (int) config('admin.company_media_max_size');
    }

    public static function getCompanyMediaMinSize(): int
    {
        return (int) config('admin.company_media_min_size');
    }

    public static function getCompanyMediaTypes(): array
    {
        return (array) config('admin.company_media_types');
    }



    public static function getBranchMediaDisk(): string
    {
        return (string) config('admin.branch_media_disk') ?? 'public';
    }

    public static function getBranchMediaDirectory(?string $folder = null): string
    {
        return config('admin.branch_media_folder').($folder ? DIRECTORY_SEPARATOR.$folder : '');
    }

    public static function getBranchMediaMaxSize(): int
    {
        return (int) config('admin.branch_media_max_size');
    }

    public static function getBranchMediaMinSize(): int
    {
        return (int) config('admin.branch_media_min_size');
    }

    public static function getBranchMediaTypes(): array
    {
        return (array) config('admin.branch_media_types');
    }


    public static function getContactTypes(): array
    {
        return ContactType::all();
    }




    //Banner Image
    public static function getBannerImageDirectory(?string $folder = null): string
    {
        return config('admin.banner_image_folder').($folder ? DIRECTORY_SEPARATOR.$folder : '');
    }

    public static function getBannerImageDisk(): string
    {
        return (string) config('admin.banner_image_disk') ?? 'public';
    }

    public static function getBannerImageMaxSize(): int
    {
        return (int) config('admin.banner_image_max_size');
    }

    public static function getBannerImageMinSize(): int
    {
        return (int) config('admin.banner_image_min_size');
    }

    public static function getBannerImageTypes(): array
    {
        return (array) config('admin.banner_image_types');
    }

    //Company Media
    public static function getSettingMediaDirectory(?string $folder = null): string
    {
        return config('admin.setting_media_folder').($folder ? DIRECTORY_SEPARATOR.$folder : '');
    }

    public static function getSettingMediaDisk(): string
    {
        return (string) config('admin.setting_media_disk') ?? 'public';
    }

    public static function getSettingMediaMaxSize(): int
    {
        return (int) config('admin.setting_media_max_size');
    }

    public static function getSettingMediaMinSize(): int
    {
        return (int) config('admin.setting_media_min_size');
    }

    public static function getSettingMediaTypes(): array
    {
        return (array) config('admin.setting_media_types');
    }
}
