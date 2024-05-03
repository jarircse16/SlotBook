<?php

use App\Http\Controllers\EmailAlertController;
use App\Http\Controllers\SlotUpdateController;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\VerifyInternalToken;
use Illuminate\Support\Facades\Route;

// Fallback route
Route::fallback(function () {
    return response()->view('404', [], 404); // Optionally set the 404 HTTP status
});

//Default Route
Route::get('/', function () {
    return view('home');
});

Route::get('/clear-cache', [SlotUpdateController::class, 'clearCache'])->name('cache.clear');

//Fetch Slot Dates in a secured way, so that others if steal our api, can't run properly.
// Route::middleware([CorsMiddleware::class, VerifyInternalToken::class])
//     ->get('/api/slot-update', [SlotUpdateController::class, 'fetchSlotUpdate']);

Route::get('/api/slot-update', [SlotUpdateController::class, 'fetchSlotUpdate']);

//Get Alert
Route::get('/set_alert', [EmailAlertController::class, 'showForm']);
Route::post('/set_alert', [EmailAlertController::class, 'storeEmail']);

//Delete Alert
Route::get('/delete_alert', function () {
    return view('delete_alert');
})->name('show_delete_form');
Route::post('/delete_alert', [EmailAlertController::class, 'deleteEmail'])->name('delete_alert');
