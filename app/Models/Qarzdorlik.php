<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Davlatlar;
use App\Models\User;
class Qarzdorlik extends Model
{
    use HasFactory;

    protected $table = 'qarzdorliklar';

    
    public function davlat()
    {
        return $this->belongsTo(Davlatlar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
