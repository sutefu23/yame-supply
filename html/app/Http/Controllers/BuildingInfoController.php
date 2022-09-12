<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingInfoRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;

class BuildingInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        UserCollection::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BuildingInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BuildingInfoRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingInfoRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
