<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

/**
 * CountrySeeder
 */
class CountrySeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('countries.countries') as $country) {
            Country::updateOrcreate(
                ['name' => $country],
                ['name' => $country]
            );
        }
    }
}
