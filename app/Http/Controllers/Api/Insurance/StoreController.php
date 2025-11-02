<?php

namespace App\Http\Controllers\Api\Insurance;

use App\Http\Actions\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Insurance;

/**
 * StoreController
 */
class StoreController extends Controller
{
    /**
     * @param \App\Http\Requests\StoreRequest $request
     * @param \App\Http\Actions\StoreAction $action
     * @return \App\Models\Insurance
     */
   public function __invoke(StoreRequest $request, StoreAction $action): Insurance
   {
        return $action->handle($request->validated());
   }
}
