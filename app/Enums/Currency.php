<?php

namespace App\Enums;

enum Currency: string
{
    case euro = 'Euro';
    case dollar = 'Dollar';
    case pound = 'Pound';

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
        return self::euro->value;
    }



}
