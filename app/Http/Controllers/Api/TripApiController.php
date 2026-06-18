<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;

class TripApiController extends Controller
{
    public function index(): JsonResponse
    {
        $trips = Trip::with(['vehicle', 'driver'])->get();

        return response()->json($trips);
    }

}
