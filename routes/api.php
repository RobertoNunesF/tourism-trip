<?php

use App\Http\Controllers\Api\TripApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trips',[TripApiController::class,'index']);
