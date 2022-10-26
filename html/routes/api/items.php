<?php

    use App\Http\Requests\InStockInfoRequest;
    use App\Http\Requests\ItemRequest;
    use App\Models\InStockDetail;
    use App\Models\InStockInfo;
    use App\Models\Item;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;

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
