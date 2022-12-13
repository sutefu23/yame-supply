<?php

    use App\Http\Requests\UserRequest;
    use App\Models\User;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Hash;

    Route::get('/users', function (UserRequest $request){
        return new JsonResource(User::where($request->validated())->get());
    });

    Route::post('/users', function (UserRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data["password"]);
        return User::create($data);
    });

    Route::patch('/users/{id}', function (UserRequest $request, int $id){
        $data = $request->validated();
        $hashed_password = (function() use ($id, $data){
            if(empty($data["password"])){
                return User::find($id);
            }else{
                return Hash::make($data["password"]);

            }}
        )();
        $data['password'] = $hashed_password;
        return User::where('id', $id)->update($data);
    });
