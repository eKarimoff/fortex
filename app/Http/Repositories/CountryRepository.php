<?php

namespace App\Http\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository extends BaseRepository
{
    public function __construct(Country $country)
    {
        parent::__construct($country);

    }
    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCountries(): Collection
    {
        return $this->all();
    }
}
