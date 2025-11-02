<?php

namespace App\Http\Actions\Contracts;

/**
 * Interface
 */
interface BaseActionInterface
{
    /**
     * @return mixed
     */
    public function execute(): mixed;
}
