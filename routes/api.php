<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/userAuth', [LoginController::class, 'userAuth']);
Route::get('/userProfile', [ProfileController::class, 'userProfile']);
Route::apiResource('events', EventController::class);
//Route::apiResource('events.attendees',AttendeeController::class)->scoped(['attendee'=>'event']);
//Route::apiResource('events.attendees',AttendeeController::class)->scoped();
Route::apiResource('events.attendees', AttendeeController::class)->scoped()->except(['update']);
