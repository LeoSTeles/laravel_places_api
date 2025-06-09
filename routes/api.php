<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaceController;

Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'API is working!']);
    });

    // Aqui suas outras rotas da API
    Route::apiResource('places', PlaceController::class);
});


