<?php

    use App\Http\Requests\BuildingInfoRequest;
    use App\Http\Requests\InStockInfoRequest;
    use App\Http\Requests\ItemRequest;
    use App\Http\Requests\OutStockInfoRequest;
    use App\Models\BuildingInfo;
     use App\Models\InStockInfo;
    use App\Models\Item;
    use App\Models\OutStockInfo;
    use Carbon\Carbon;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;

    Route::get('/items', function (){
        return new JsonResource(Item::with(['wood_species','unit','warehouse'])->get());
    });

    Route::post('/items', function (ItemRequest $request){
        return new JsonResource(Item::create($request->validated()));
    });

    Route::get('/InStockInfo', function (){
        return new JsonResource(InStockInfo::with(['in_stock_details','user', 'warehouse'])->get());
    });

    Route::post('/InStockInfo', function (InStockInfoRequest $request){
        $data = $request->validated();
        DB::beginTransaction();
        $inStockInfo = InStockInfo::create($data);
        $inStockInfo->in_stock_details()->createMany($data['in_stock_details']);
        DB::commit();
        return new JsonResource($inStockInfo);
    })->name('InStockInfo.post');


    Route::get('/OutStockInfo', function (){
        return new JsonResource(OutStockInfo::with(['out_stock_details','user', 'warehouse'])->get());
    });

    Route::post('/OutStockInfo', function (OutStockInfoRequest $request){
        $data = $request->validated();
        DB::beginTransaction();
        $outStockInfo = OutStockInfo::create($data);
        $outStockInfo->out_stock_details()->createMany($data['out_stock_details']);
        DB::commit();
        return new JsonResource($outStockInfo);
    })->name('OutStockInfo.post');


    Route::get('/BuildingInfo/{id?}', function (Request $request, int|null $id){
        $beforeMonth = Carbon::today()->subMonth();
        return new JsonResource(BuildingInfo::whereDate('time_limit','>', $beforeMonth)::find($id)::with(['user'])->get());
    });

    Route::post('/BuildingInfo', function (BuildingInfoRequest $request){
        $data = $request->validated();
        DB::beginTransaction();
        $buildingInfo = BuildingInfo::create($data);
        $buildingInfo->building_info_details()->createMany($data['building_info_details']);
        DB::commit();
        return new JsonResource($buildingInfo);
    })->name('BuildingInfo.post');
