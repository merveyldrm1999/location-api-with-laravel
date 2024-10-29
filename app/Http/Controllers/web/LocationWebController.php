<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\web\LocationWebService;

class LocationWebController extends Controller
{
    protected LocationWebService $locationWebService;

    public function __construct(LocationWebService $locationWebService)
    {
        $this->locationWebService = $locationWebService;
    }

    public function index(): \Illuminate\View\View
    {
        $model = $this->locationWebService->index();

        return view('welcome', compact('model'));
    }
}
