<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'packages.'], function () {
    Route::get('/', [PackageController::class, 'index'])->name('index');
    Route::get('/create', [PackageController::class, 'create'])->name('create');
    Route::post('/store', [PackageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PackageController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [PackageController::class, 'destroy'])->name('destroy');
});
