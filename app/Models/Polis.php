<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Davlatlar;
use App\Models\User;

class Polis extends Model
{
    use HasFactory;

    protected $table = 'polislar';

    public function davlat()
    {
        return $this->belongsTo(Davlatlar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getTotalAttribute()
    {
       return $this->sum('summa');
    }
}
