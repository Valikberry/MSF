<?php

namespace App\Enums;

use App\Enums\Contracts\HasSelectOption;

enum PaymentMethod: string implements HasSelectOption
{
    case cash = 'Cash';
    case online_payment = 'Online Payment';


    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $data[$case->name] = $case->value;
        }
        return $data;
    }

    public static function names(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }


    public static function getName($name): string
    {
        foreach (self::cases() as $case) {
            if ($case->name == $name) {
                return __($case->value);
            }
        }
        return '';
    }

    public static function getSelectOption(): array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $data[$case->value] = $case->value;
        }
        return $data;
    }

}

