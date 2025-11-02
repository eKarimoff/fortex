<?php

namespace App\Http\Controllers\Api\General;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CountryRepository;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Get countries controller
 */
class CountryController extends Controller
{
    /**
     * @param \App\Http\Repositories\CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        return CountryResource::collection($this->countryRepository->all());
    }
}
