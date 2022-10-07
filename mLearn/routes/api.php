<?php

use App\Http\Controllers\UserController;
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

Route::prefix('user')->group(function () {
    Route::post('/store', [UserController::class, 'store']);

    Route::put('/upgrade/{userExternalId}', [UserController::class, 'upgrade']);

    Route::put('/downgrade/{userExternalId}', [UserController::class, 'downgrade']);
});
