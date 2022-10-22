<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
    Route::get('/', [PaymentController::class, 'payment'])->name('index');

    Route::post('process-transaction', [PaymentController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PaymentController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PaymentController::class, 'cancelTransaction'])->name('cancelTransaction');



    Route::get('stripe', [PaymentController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');
});
