<?php

namespace App\Services;

use App\Models\Location as Model;

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
}
