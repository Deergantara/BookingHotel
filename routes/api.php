<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes untuk External Services
|--------------------------------------------------------------------------
*/

// Midtrans Notification
Route::post('/midtrans-notification', function () {
    \Log::info('Midtrans Notification Received', [
        'payload' => request()->all(),
        'headers' => request()->headers->all()
    ]);

    return response()->json([
        'status_code' => 200,
        'message' => 'Notification handled successfully'
    ]);
});

// Payment Routes (API)
Route::post('/payment/notification', [App\Http\Controllers\PaymentController::class, 'notification']);
