<?php

use Illuminate\Contracts\Auth\Authenticatable;


if (!function_exists('isAuthAdmin')) {
    function isAuthAdmin(): bool
    {
        return auth('web')->check();
    }
}

if (!function_exists('getAdminId')) {
    function getAdminId(): int|null
    {
        return isAuthAdmin() ? (int) auth('web')->id() : null;
    }
}

if (!function_exists('getAdmin')) {
    function getAdmin(): ?Authenticatable
    {
        return isAuthAdmin() ? auth('web')->user() : null;
    }
}

if (!function_exists('getAdminEmail')) {
    function getAdminEmail(): string
    {
        return getAdmin() ? getAdmin()->email : '';
    }
}

if (!function_exists('isAuthSuperAdmin')) {
    function isAuthSuperAdmin(): bool
    {
        return in_array(getAdminEmail(), getSuperAdminEmails());
    }
}

if (!function_exists('getSuperAdminEmails')) {
    function getSuperAdminEmails(): array
    {
        return (array) config('admin.super_admins');
    }
}


if (!function_exists('getAppName')) {
    function getAppName(): string
    {
        return setting('company_name') ?? config('app.name');
    }
}

if (!function_exists('getLogoUrl')) {
    function getLogoUrl(): string
    {
        if (setting('company_logo')) {
            if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->exists(setting('company_logo'))) {
                return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->url(setting('company_logo'));
            }
        }

        return asset('frontend/images/images/logo.png');
    }
}

if (!function_exists('getLogoPath')) {
    function getLogoPath(): string
    {
        if (setting('company_logo')) {
            if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->exists(setting('company_logo'))) {
                return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->path(setting('company_logo'));
            }
        }

        return public_path('frontend/images/logo.png');
    }
}

if (!function_exists('getInvoiceLogoPath')) {
    function getInvoiceLogoPath(): string
    {
        /*if (setting('company_logo')) {
            if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->exists(setting('company_logo'))) {
                return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->path(setting('company_logo'));
            }
        }*/

        return public_path('assets/frontend/images/invoice-logo.png');
    }
}

if (!function_exists('getFaviconUrl')) {
    function getFaviconUrl(): string
    {
        return asset('images/favicon.png');
    }
}

if (!function_exists('getPrimaryColor')) {
    function getPrimaryColor(): string
    {
        return config('admin.primary_color');
    }
}

if (!function_exists('isOnProduction')) {
    function isOnProduction(): bool
    {
        return config('app.env') == 'production';
    }
}

if (!function_exists('getAppUrl')) {
    function getAppUrl(): string
    {
        return config('app.url');
    }
}

if (!function_exists('getCurrencySymbol')) {
    function getCurrencySymbol(): string
    {
        if (setting('currency') == \App\Enums\Currency::euro->name) {
            return '€';
        }

        if (setting('currency') == \App\Enums\Currency::pound->name) {
            return '£';
        }

        if (setting('currency') == \App\Enums\Currency::dollar->name) {
            return '$';
        }

        return '€';
    }
}

if (!function_exists('getPhoneCode')) {
    function getPhoneCode(): string
    {
        return setting('phone_code') ?? config('admin.phone_code');
    }
}


if (!function_exists('getSliderImageUrl')) {
    function getSliderImageUrl($image): string
    {
        if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getBannerImageDisk())->exists($image)) {
            return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getBannerImageDisk())->url($image);
        }

        return $image;
    }
}

/*if (!function_exists('getServiceImageUrl')) {
    function getServiceImageUrl($image): string
    {
        if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getServiceMediaDisk())->exists($image)) {
            return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getServiceMediaDisk())->url($image);
        }

        return $image;
    }
}*/

if (!function_exists('getBranchImageUrl')) {
    function getBranchImageUrl($image): string
    {
        if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->exists($image)) {
            return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getBranchMediaDisk())->url($image);
        }

        return $image;
    }
}

if (!function_exists('getCompanyLogoUrl')) {
    function getCompanyLogoUrl(string $image): string
    {
        if (\Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->exists($image)) {
            return \Illuminate\Support\Facades\Storage::disk(\App\Configuration\Admin::getCompanyMediaDisk())->url($image);
        }

        return $image;
    }
}


if (!function_exists('showPrice')) {
    function showPrice($price): string
    {
        return getCurrencySymbol()."".$price;
    }
}

if (!function_exists('getBookingSession')) {
    function getBookingSession(): array
    {
        return \App\Libraries\Booking\BookingSession::getSession();
    }
}

if (!function_exists('bookingSession')) {
    function bookingSession($key): mixed
    {
        return \App\Libraries\Booking\BookingSession::get($key);
    }
}

if (!function_exists('getBookingStep')) {
    function getBookingStep(): int
    {
        return (int) \App\Libraries\Booking\BookingSession::get('step');
    }
}

if (!function_exists('getCart')) {
    function getCart(): mixed
    {
        return \App\Libraries\Booking\BookingSession::get('services');
    }
}

if (!function_exists('getCartQuantityByServiceId')) {
    function getCartQuantityByServiceId(int $serviceId): mixed
    {
        $quantity = 0;
        foreach (getCart() as $item) {
            if (isset($item['service_id']) && $item['service_id'] == $serviceId) {
                $quantity += $item['quantity'];
            }
        }
        return $quantity;
    }
}

if (!function_exists('getCartTotalPrice')) {
    function getCartTotalPrice(): float
    {
        $total = 0;
        foreach (getCart() as $service) {
            $total += $service['price'] * $service['quantity'];
        }
        return $total;
    }
}

if (!function_exists('getCartTotalQuantity')) {
    function getCartTotalQuantity(): int
    {
        $total = 0;
        foreach (getCart() as $service) {
            $total += $service['quantity'];
        }
        return $total;
    }
}

if (!function_exists('getServiceTotalPrice')) {
    function getServiceTotalPrice(int $serviceId): float
    {
        $total = 0;
        foreach (getCart() as $service) {
            if ($service['id'] == $serviceId) {
                $total = $service['price'] * $service['quantity'];
            }
        }
        return $total;
    }
}

if (!function_exists('getServiceQuantity')) {
    function getServiceQuantity(int $serviceId): float
    {
        $total = 0;
        foreach (getCart() as $service) {
            if ($service['service_id'] == $serviceId) {
                return $service['quantity'];
            }
        }
        return $total;
    }
}

if (!function_exists('getQuantityFromExistingServices')) {
    function getQuantityFromExistingServices(array $services, int $serviceId): float
    {
        foreach ($services as $service) {
            if ($service['service_id'] == $serviceId) {
                return $service['quantity'];
            }
        }
        return 0;
    }
}

function getReadableDate($date): string
{
    return date('M d, Y', strtotime($date));
}

function getReadableTime($date): string
{
    return date('h:i A', strtotime($date));
}

function getPerServiceMeasureType(string $type): string
{
    if (\App\Enums\ServiceMeasureType::hour->name == $type) {
        return __('Per Hour');
    }
    if (\App\Enums\ServiceMeasureType::piece->name == $type) {
        return __('Per Piece');
    }
    if (\App\Enums\ServiceMeasureType::yard->name == $type) {
        return __('Per Yard');
    }
    return '';
}

function getServiceMeasureType(string $type, int $quantity = 1): string
{
    if (\App\Enums\ServiceMeasureType::hour->name == $type) {
        return $quantity > 1 ? __('Hours') : __('Hour');
    }
    if (\App\Enums\ServiceMeasureType::piece->name == $type) {
        return $quantity > 1 ? __('Pieces') : __('Piece');
    }
    if (\App\Enums\ServiceMeasureType::yard->name == $type) {
        return $quantity > 1 ? __('Yards') : __('Yard');
    }
    return '';
}


function getAuthor()
{
    return setting('site_author') ?? '';
}

function isWhatsappSmsEnabled()
{
    return config('services.whatsapp.enable');
}

function getDataForJsonField(array $data): array
{
    $newData = [];

    foreach ($data as $item) {
        $isValid = true;
        foreach ($item as $key => $value) {
            if (is_null($value) || $value == '') {
                $isValid = false;
            }
        }

        if ($isValid) {
            $newData[] = $item;
        }
    }

    return $newData;
}


function mergeWithCartItems($array1, $array2): array
{
    $combined = [];

    foreach ($array1 as $item) {
        $key = $item['company_id'] . '_' . $item['service_id'];
        $combined[$key] = $item;
    }

    foreach ($array2 as $item) {
        $key = $item['company_id'] . '_' . $item['service_id'];
        // Override existing entries in the combined array
        $combined[$key] = $item;
    }

    // Remove items with quantity 0
    $filtered = array_filter($combined, function($item) {
        return $item['quantity'] > 0;
    });

    // Reindex array to get a zero-based array
    $result = array_values($filtered);

    usort($result, function($a, $b) {
        return $a['company_id'] <=> $b['company_id'];
    });

    return $result;
}


function getServiceTotalPriceFromServices(array $services): float
{
    $total = 0;
    foreach ($services as $item) {
        $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
    }
    return round($total);
}

function isInProduction(): bool
{
    return config('app.env') === 'production';
}
