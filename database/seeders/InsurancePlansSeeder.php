<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsurancePlan;

/**
 * Insurance plan seeder
 */
class InsurancePlansSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        foreach (config('insurance_plans') as $plan) {
            InsurancePlan::updateOrCreate([
                'insurance_type_id' => $plan['insurance_type_id'],
                'name'              => $plan['name'],
                'price'             => $plan['price'],
                'duration'          => $plan['duration'],
            ]);
        }
    }
}
