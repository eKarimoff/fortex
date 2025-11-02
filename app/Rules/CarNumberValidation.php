<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Custom rule to validate car number
 */
class CarNumberValidation implements Rule
{
    /**
     * @return true
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation for car number
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
       return preg_match('/^\d{2}[A-Z]\d{3}[A-Z]{2}$/i', $value);
    }

    public function message(): string
    {
        return 'The :attribute must be a valid in this sample: 60Z777ZZ';
    }
}
