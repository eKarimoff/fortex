<?php

namespace App\Http\Actions;

use App\Http\Actions\Contracts\BaseActionInterface;

abstract class BaseAction implements BaseActionInterface
{
    public function execute(...$params): mixed
    {
        return $params;
    }
}
