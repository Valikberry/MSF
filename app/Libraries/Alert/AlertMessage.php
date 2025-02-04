<?php

namespace App\Libraries\Alert;

class AlertMessage
{

    public static function key(): string
    {
        return 'alert_message';
    }


    public static function success(string $title, string $description = null): void
    {
        session()->flash(self::key(), [
            'title' => $title,
            'description' => $description,
            'type' => 'success'
        ]);
    }

    public static function error(string $title, string $description = null): void
    {
        session()->flash(self::key(), [
            'title' => $title,
            'description' => $description,
            'type' => 'error'
        ]);
    }


}
