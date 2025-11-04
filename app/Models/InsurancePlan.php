<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Insurance plan model
 */
class InsurancePlan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
    ];
}
