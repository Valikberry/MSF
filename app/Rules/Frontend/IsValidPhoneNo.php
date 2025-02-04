<?php

namespace App\Rules\Frontend;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsValidPhoneNo implements ValidationRule
{
    private string $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isValidPhoneNo = preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value);

        if (!$isValidPhoneNo) {
            $fail(strlen($this->message) > 0 ? $this->message : trans('Phone no is invalid'));
        }
    }
}
