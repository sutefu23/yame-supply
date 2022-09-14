<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
    use App\Http\Requests\ItemRequest;
    use App\Http\Requests\UserRequest;
    use App\Models\Item;
    use App\Models\User;
    use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['auth', 'api'])->group(function () {
        Route::get('/users/me', function (){
            return new JsonResource(User::query()->findOrFail(Auth()->id()));
        });

        Route::get('/users', function (){
            return new JsonResource(User::all());
        });

        Route::post('/users', function (UserRequest $request){
            return new JsonResource(User::query()->create($request->validated()));
        });

    });

    Route::middleware(['auth', 'api'])->group(function () {
        Route::get('/items', function (){
            return new JsonResource(Item::all());
        });

        Route::post('/items', function (ItemRequest $request){
            return new JsonResource(Item::query()->create($request->validated()));
        });
    });
