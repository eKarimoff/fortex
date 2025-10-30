<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return User::all();
    }
}
