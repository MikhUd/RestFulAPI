<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
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

Route::get('country', [\App\Http\Controllers\API\CountryController::class, 'country']);

Route::get('country/{id}', [\App\Http\Controllers\API\CountryController::class, 'get_country']);

Route::post('country', [\App\Http\Controllers\API\CountryController::class, 'add_country']);

Route::put('country/{id}', [\App\Http\Controllers\API\CountryController::class, 'edit_country']);

Route::delete('country/{id}', [\App\Http\ControllersAPI\CountryController::class, 'delete_country']);

Route::post('login', [\App\Http\Controllers\API\Auth\LoginController::class, 'login']);