<?php

namespace App\Http\Repositories;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class InsuranceRepository extends BaseRepository
{
    /**
     * Constructor method
     * @param \App\Models\Insurance $insurance
     */
    public function __construct(Insurance $insurance)
    {
        parent::__construct($insurance);
    }
    /**
     * Get all insurances
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInsurances(): Collection
    {
        return $this->all();
    }
}
