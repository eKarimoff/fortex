<?php

namespace App\Http\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository
{
    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Country::all();
    }
}
