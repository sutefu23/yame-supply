<?php

    use App\Http\Requests\BuildingInfoRequest;
    use App\Http\Requests\InStockInfoRequest;
    use App\Http\Requests\ItemEssentialPatchRequest;
    use App\Http\Requests\ItemOffsetPatchRequest;
    use App\Http\Requests\ItemRequest;
    use App\Http\Requests\OutStockInfoRequest;
    use App\Http\Service\ItemService;
    use App\Http\Service\StockService;
    use App\Models\BuildingInfo;
    use App\Models\BuildingInfoDetail;
    use App\Models\InStockInfo;
    use App\Models\Item;
    use App\Models\OutStockInfo;
    use Carbon\Carbon;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;

    Route::get('/items', function () {
        return new JsonResource(ItemService::getItemWithActiveBuildInfo());
    });

    Route::post('/items', function (ItemRequest $request) {
        return new JsonResource(Item::create($request->validated()));
    })->name('Items.post');

    Route::patch('/items/{id}', function (ItemRequest $request, $id) {
        Item::whereId($id)->update($request->validated());
        return new JsonResource(Item::whereId($id)->get());
    })->name('Items.patch');


//    Route::patch('/items/quantity', function (ItemOffsetPatchRequest $request) {
//        $data = $request->validated();
//        ItemService::modifyEssential($data['items']);
//        return new JsonResource(Item::with(['wood_species','unit','warehouse'])->get());
//    })->name('Items.post.quantity');

    Route::get('/InStockInfo', function () {
        return new JsonResource(InStockInfo::with(['in_stock_details','user', 'warehouse'])->get());
    });


    Route::post('/InStockInfo', function (InStockInfoRequest $request) {
        $data = $request->validated();
        $inStockInfo = StockService::inStock($data);
        return new JsonResource($inStockInfo);
    })->name('InStockInfo.post');


    Route::get('/OutStockInfo', function () {
        return new JsonResource(OutStockInfo::with(['out_stock_details','user', 'warehouse'])->get());
    });

    Route::post('/OutStockInfo', function (OutStockInfoRequest $request) {
        $data = $request->validated();
        $outStockInfo = StockService::outStock($data);
        return new JsonResource($outStockInfo);
    })->name('OutStockInfo.post');

    Route::get('/BuildingInfo/', function (Request $request) {
        return new JsonResource(BuildingInfo::with(['user','building_info_details'])->where(function ($query) use ($request) {
            $id = $request->query('id');
            $is_exported = $request->query('is_exported');
//            $beforeMonth = Carbon::today()->subMonth();
//            $query->whereDate('export_expected_date', '>', $beforeMonth);
            if ($id) {
                $query->whereId($id);
            }
            if ($is_exported) {
                $query->where('is_exported', '=', $is_exported === 'true');
            }
        })->orderBy("export_expected_date", "desc")->get());
    })->name('BuildingInfo');

    Route::patch('/BuildingInfo/{id}', function (BuildingInfoRequest $request, int $id) {
        $data = $request->validated();
        DB::beginTransaction();
        foreach ($data['building_info_details'] as $info_detail) {
            BuildingInfoDetail::where(['build_info_id' => $id, 'item_id' => $info_detail['item_id']])->update(['item_quantity' => $info_detail['item_quantity']]);
        }
        unset($data['building_info_details']);
        BuildingInfo::whereId($id)->update($data);
        DB::commit();
        return true;
    })->name('BuildingInfo.post');


    Route::post('/BuildingInfo', function (BuildingInfoRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        $buildingInfo = BuildingInfo::create($data);
        $buildingInfo->building_info_details()->createMany($data['building_info_details']);
        DB::commit();
        return new JsonResource($buildingInfo);
    })->name('BuildingInfo.post');
