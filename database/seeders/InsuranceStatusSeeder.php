<?php

namespace Database\Seeders;

use App\Models\InsuranceStatus;
use App\Enums\InsuranceStatusEnum;
use Illuminate\Database\Seeder;

/**
 * InsuranceStatusSeeder
 */
class InsuranceStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statues = InsuranceStatusEnum::cases();

        foreach ($statues as $status) {
            InsuranceStatus::updateOrCreate(
                ['status' => $status->value],
                ['status' => $status->value]
            );
        }
    }
}
