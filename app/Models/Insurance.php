<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Insurance model
 */
class Insurance extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'insurance_type_id',
        'insurance_status_id',
        'car_number',
        'insurance_number',
        'client_name',
        'start_date',
        'end_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
