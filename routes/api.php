<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-feedback', [GameController::class, 'getFeedback']);
Route::delete('/delete-feedback/{id}', [GameController::class, 'deleteFeedback']);