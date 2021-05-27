<?php

use App\Http\Controllers\CalendarEvent\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('calendar-events')->group(function() {
    Route::get('/', [EventController::class, 'findAll']);
    Route::post('/create', [EventController::class, 'create'])->name('event.create');
});
