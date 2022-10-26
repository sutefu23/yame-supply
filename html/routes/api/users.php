<?php

    use App\Http\Requests\UserRequest;
    use App\Models\User;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;

    Route::get('/users', function (UserRequest $request){
        return new JsonResource(User::where($request->validated())->get());
    });

    Route::post('/users', function (UserRequest $request){
        return new JsonResource(User::create($request->validated())->get());
    });

    Route::patch('/users/{id}', function (UserRequest $request, int $id){
        return new JsonResource(User::where('id', $id)->updateOrFail($request->validated()));
    });
