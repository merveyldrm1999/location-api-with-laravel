<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistanceRequest;
use App\Services\DistanceService;
use Illuminate\Http\Request;

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
