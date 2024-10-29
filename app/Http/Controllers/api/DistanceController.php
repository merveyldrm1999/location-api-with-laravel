<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistanceRequest;
use App\Services\api\DistanceService;

class DistanceController extends Controller
{
    protected DistanceService $distanceService;

    public function __construct(DistanceService $distanceService)
    {
        $this->distanceService = $distanceService;
    }

    public function route(DistanceRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->distanceService->route($request->only(['latitude', 'longitude']));
    }

    public function show(DistanceRequest $request, int $location): \Illuminate\Http\JsonResponse
    {
        return $this->distanceService->show($request->only(['latitude', 'longitude']), $location);
    }

}
