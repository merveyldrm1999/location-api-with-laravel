<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Services\api\LocationService;

class LocationController extends Controller
{
    protected LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->index();
    }

    public function store(LocationRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->store($request->only(['name', 'latitude', 'longitude', 'hex']));
    }

    public function show(int $location): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->show($location);
    }


    public function update(LocationRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->update($request->only(['name', 'latitude', 'longitude', 'hex']), $id);
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->destroy($id);
    }

    public function withDestroy(): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->withDestroy();
    }

}
