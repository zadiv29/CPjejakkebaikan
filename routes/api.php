<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payment/callback', [FrontController::class, 'paymentCallback'])
    ->name('payment.callback');

Route::post('/payment/donation/callback', [DonationController::class, 'paymentCallback'])
    ->name('payment.donation.callback');
