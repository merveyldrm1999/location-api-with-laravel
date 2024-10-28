<?php

namespace App\Services;

use App\Models\Location as Model;

class DistanceService
{
    public function route(array $only)
    {
        $model = Model::all();
        $distance = [];

        foreach ($model as $item) {
            $distance[] = [
                'id' => $item->id,
                'name' => $item->name,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'distance' => $this->haversineDistance($only['latitude'], $only['longitude'], $item->latitude, $item->longitude),
            ];
        }

        return response()->json($distance);
    }


    public static function haversineDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371): float|int
    {
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
