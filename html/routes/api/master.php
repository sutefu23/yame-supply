<?php

    use App\Http\Requests\UnitRequest;
    use App\Http\Requests\UserCategoryRequest;
    use App\Http\Requests\WarehouseRequest;
    use App\Http\Requests\WoodSpeciesRequest;
    use App\Models\Unit;
    use App\Models\UserCategory;
    use App\Models\Warehouse;
    use App\Models\WoodSpecies;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;

    Route::get('/UserCategory', function () {
        return new JsonResource(UserCategory::all());
    });

    Route::post('/UserCategory', function (UserCategoryRequest $request) {
        return new JsonResource(UserCategory::create($request->validated()));
    });
    Route::patch('/UserCategory/{id}', function (UserCategoryRequest $request, $id) {
        return new JsonResource(UserCategory::whereId($id)->update($request->validated()));
    });
    Route::delete('/UserCategory/{id}', function ($id) {
        return new JsonResource(UserCategory::whereId($id)->delete());
    });

    Route::get('/Warehouse', function () {
        return new JsonResource(Warehouse::all());
    });

    Route::post('/Warehouse', function (WarehouseRequest $request) {
        return new JsonResource(Warehouse::create($request->validated()));
    });
    Route::patch('/Warehouse/{id}', function (WarehouseRequest $request, $id) {
        return new JsonResource(Warehouse::whereId($id)->update($request->validated()));
    });
    Route::delete('/Warehouse/{id}', function ($id) {
        return new JsonResource(Warehouse::whereId($id)->delete());
    });

    Route::get('/Unit', function () {
        return new JsonResource(Unit::all());
    });

    Route::post('/Unit', function (UnitRequest $request) {
        return new JsonResource(Unit::create($request->validated()));
    });
    Route::patch('/Unit/{id}', function (UnitRequest $request, $id) {
        return new JsonResource(Unit::whereId($id)->update($request->validated()));
    });
    Route::delete('/Unit/{id}', function ($id) {
        return new JsonResource(Unit::whereId($id)->delete());
    });

    Route::get('/WoodSpecies', function () {
        return new JsonResource(WoodSpecies::all());
    });

    Route::post('/WoodSpecies', function (WoodSpeciesRequest $request) {
        return new JsonResource(WoodSpecies::create($request->validated()));
    });
    Route::patch('/WoodSpecies/{id}', function (WoodSpeciesRequest $request, $id) {
        return new JsonResource(WoodSpecies::whereId($id)->update($request->validated()));
    });
    Route::delete('/WoodSpecies/{id}', function ($id) {
        return new JsonResource(WoodSpecies::whereId($id)->delete());
    });

