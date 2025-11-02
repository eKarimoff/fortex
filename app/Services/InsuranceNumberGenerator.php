<?php

namespace App\Services;

/**
 * InsuranceNumberGenerator class
 */
class InsuranceNumberGenerator
{
    /**
     * Get generated insurance number
     * @return string
     */
    public function generateInsuranceNumber(): string
    {
        return chr(rand(65, 90)) . chr(rand(65, 90)). '-' . rand(100000, 999999);
    }
}
