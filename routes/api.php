<?php

use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\MobileAppController;
use App\Http\Controllers\API\ServicesController;
use App\Http\Controllers\API\SubscribeController;
use App\Http\Controllers\API\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::post('/order', [MobileAppController::class, 'orderStore']);

Route::get('blogs', [BlogController::class, 'index']);
Route::get('blog/show/{id}', [BlogController::class, 'show']);

Route::get('services', [ServicesController::class, 'index']);
Route::get('packages', [MobileAppController::class, 'Packages']);

Route::get('sliders', [MobileAppController::class, 'sliders']);
Route::post('contact', [MobileAppController::class, 'contactStore']);

Route::post('/save-token', [MobileAppController::class, 'SaveToken']);


Route::middleware('auth:api')->group(function () {
    Route::get('works', [WorkController::class, 'index']);
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('blogs/trashed', [BlogController::class, 'blogsTrashed']);
    Route::post('blog/store', [BlogController::class, 'store']);
    Route::post('blog/update/{blog}', [BlogController::class, 'update']);
    Route::get('blog/destroy/{blog}', [BlogController::class, 'destroy']);
    Route::get('blog/hdelete/{blog}', [BlogController::class, 'hdelete']);
    Route::get('blog/restore/{id}', [BlogController::class, 'restore']);


    Route::get('clients/trashed', [ClientController::class, 'clientsTrashed']);
    Route::post('client/store', [ClientController::class, 'store']);
    Route::get('client/show/{id}', [ClientController::class, 'show']);
    Route::post('client/update/{client}', [ClientController::class, 'update']);
    Route::get('client/destroy/{client}', [ClientController::class, 'destroy']);
    Route::get('client/hdelete/{client}', [ClientController::class, 'hdelete']);
    Route::get('client/restore/{id}', [ClientController::class, 'restore']);


    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/trashed', [ContactController::class, 'contactsTrashed']);
    Route::post('contact/store', [ContactController::class, 'store']);
    Route::get('contact/destroy/{contact}', [ContactController::class, 'destroy']);
    Route::get('contact/hdelete/{contact}', [ContactController::class, 'hdelete']);
    Route::get('contact/restore/{id}', [ContactController::class, 'restore']);


    Route::get('services/trashed', [ServicesController::class, 'servicesTrashed']);
    Route::post('service/store', [ServicesController::class, 'store']);
    Route::get('service/show/{id}', [ServicesController::class, 'show']);
    Route::post('service/update/{service}', [ServicesController::class, 'update']);
    Route::get('service/destroy/{service}', [ServicesController::class, 'destroy']);
    Route::get('service/hdelete/{service}', [ServicesController::class, 'hdelete']);
    Route::get('blog/restore/{id}', [ServicesController::class, 'restore']);


    Route::get('subscribes', [SubscribeController::class, 'index']);
    Route::get('subscribes/trashed', [SubscribeController::class, 'subscribesTrashed']);
    Route::post('subscribe/store', [SubscribeController::class, 'store']);
    Route::get('subscribe/destroy/{subscribe}', [SubscribeController::class, 'destroy']);
    Route::get('subscribe/hdelete/{subscribe}', [SubscribeController::class, 'hdelete']);
    Route::get('subscribe/restore/{id}', [SubscribeController::class, 'restore']);


    Route::get('works/trashed', [WorkController::class, 'worksTrashed']);
    Route::post('work/store', [WorkController::class, 'store']);
    Route::get('work/show/{id}', [WorkController::class, 'show']);
    Route::post('work/update/{work}', [WorkController::class, 'update']);
    Route::get('work/update/favorite/{work}', [WorkController::class, 'updateFavorite']);
    Route::get('work/destroy/{work}', [WorkController::class, 'destroy']);
    Route::get('work/hdelete/{work}', [WorkController::class, 'hdelete']);
    Route::get('work/restore/{id}', [WorkController::class, 'restore']);
});
