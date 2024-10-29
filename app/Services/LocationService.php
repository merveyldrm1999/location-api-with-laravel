<?php

namespace App\Services;

use App\Models\Location as Model;
use http\Env\Response;

class LocationService
{

    public function store(array $only): \Illuminate\Http\JsonResponse
    {
        $model = new Model();
        $model->fill($only);
        $model->save();
        return response()->json($model, 201);
    }

    public function show(int $location): \Illuminate\Http\JsonResponse
    {
        $model = Model::findOrFail($location);
        return response()->json($model);
    }

    public function update(array $only, int $location): \Illuminate\Http\JsonResponse
    {
        $model = Model::findOrFail($location);
        $model->fill($only);
        $model->save();
        return response()->json($model);
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Model::all());
    }

    public function destroy(int $location): \Illuminate\Http\JsonResponse
    {
        $model = Model::findOrFail($location);
        $model->delete();
        return response()->json(null, 204);
    }

    public function withDestroy(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Model::onlyTrashed()->get());
    }
}
