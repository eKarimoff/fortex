<?php

namespace App\Http\Controllers\Api\Insurance;


use App\Http\Controllers\Controller;
use App\Http\Repositories\InsuranceRepository;
use Illuminate\Http\JsonResponse;

/**
 * Get Insurances controller
 */
class IndexController extends Controller
{
    /**
     * @param \App\Http\Repositories\InsuranceRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(InsuranceRepository $repository): JsonResponse
    {
        return response()->json([
            'success' => $repository->getInsurances()
        ]);
    }
}
