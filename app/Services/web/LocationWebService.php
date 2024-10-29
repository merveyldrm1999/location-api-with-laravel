<?php

namespace App\Services\web;

use App\Models\Location as Model;

class LocationWebService
{

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Model::select('latitude', 'longitude', 'hex','name')->get();
    }
}
