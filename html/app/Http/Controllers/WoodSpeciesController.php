<?php

namespace App\Http\Controllers;

use App\Http\Requests\WoodSpeciesRequest;
use App\Models\WoodSpecies;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WoodSpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return new JsonResource(WoodSpecies::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WoodSpeciesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WoodSpeciesRequest $request)
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
        return new JsonResource(WoodSpecies::query()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WoodSpeciesRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WoodSpeciesRequest $request, $id)
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
        return new JsonResource(WoodSpecies::destroy($id));
    }
}
