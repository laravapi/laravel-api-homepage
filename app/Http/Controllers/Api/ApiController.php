<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Api;

class ApiController extends Controller
{
    public function index()
    {
        return ApiResource::collection(Api::all());
    }

    public function show(Api $service)
    {
        return new ApiResource($service);
    }
}
