<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Services\LocationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }


    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(LocationRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->store($request->only(['name', 'latitude', 'longitude', 'hex']));
    }


    public function show(int $location): \Illuminate\Http\JsonResponse
    {
        return $this->locationService->show($location);
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
