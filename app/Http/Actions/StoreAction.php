<?php

namespace App\Http\Actions;

use App\Models\Insurance;
use App\Services\InsuranceNumberGenerator;

/**
 * Store class
 */
class StoreAction extends BaseAction
{
    /**
     * Handle method to store values
     * @param $validatedValues
     * @return \App\Models\Insurance
     */
    public function handle($validatedValues): Insurance
    {
        return Insurance::create([
            'user_id'          => $validatedValues['user_id'],
            'client_name'      => $validatedValues['client_name'],
            'budget'           => $validatedValues['budget'],
            'car_number'       => $validatedValues['car_number'],
            'insurance_number' => app(InsuranceNumberGenerator::class)->generateInsuranceNumber(),
        ]);
    }
}
