<?php

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
Route::group(['middleware' => ['auth.session', 'api']], function () {
    require __DIR__ . '/api/users.php';
    require __DIR__ . '/api/master.php';
    require __DIR__ . '/api/items.php';
});
