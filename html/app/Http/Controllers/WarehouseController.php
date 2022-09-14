<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return new JsonResource(Warehouse::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WarehouseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id)
    {
        return new JsonResource(Warehouse::query()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WarehouseRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy($id)
    {
        return new JsonResource(Warehouse::destroy($id));
    }
}
