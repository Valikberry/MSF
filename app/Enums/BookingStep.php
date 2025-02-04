<?php

namespace App\Enums;

enum BookingStep: int
{
    case city = 1;
    case service = 2;
    case contact = 3;
    case location = 4;
    case moving_object = 5;
    case payment = 6;

    /**
     * Get Names
     *
     * @return array
     */
    public static function names(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    /**
     * Get Values
     *
     * @return array
     */
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    /**
     * Get All
     *
     * @return array
     */
    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $data[$case->name] = $case->value;
        }
        return $data;
    }

    /**
     * Get Value
     *
     * @param $name
     * @return string
     */
    public static function getValue($name): string
    {
        foreach (self::cases() as $case) {
            if ($case->name == $name) {
                return $case->value;
            }
        }
        return '';
    }


    public static function isValid($type): bool
    {
        return in_array($type, self::names());
    }


    public static function default(): string
    {
        return self::city->value;
    }



}
