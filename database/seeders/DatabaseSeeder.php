<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            InsuranceStatusSeeder::class,
            CountrySeeder::class,
            InsurancePlansSeeder::class,
        ]);
         User::factory(1)->create();
    }
}
