<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection|JsonResource
     */
    public function index()
    {
        return new JsonResource(\App\Models\User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResource
     */
    public function show()
    {
        return new JsonResource(User::query()->findOrFail(Auth::id()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //

    }

    /**
     * Remove the specified resou
     * rce from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy(int $id)
    {
        return new JsonResource(User::destroy($id));
    }
}
