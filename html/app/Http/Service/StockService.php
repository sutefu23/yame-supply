<?php

  namespace App\Http\Service;

  use App\Http\Requests\InStockInfoRequest;
  use App\Http\Requests\OutStockInfoRequest;
  use App\Models\InStockInfo;
  use App\Models\OutStockInfo;
  use Illuminate\Http\Resources\Json\JsonResource;

  class StockService {
      public static function inStock($data): InStockInfo|\App\Models\BaseModel {
          \DB::beginTransaction();
          $inStockInfo = InStockInfo::create($data);
          $inStockInfo->in_stock_details()->createMany($data['in_stock_details']);
          \DB::commit();
          return $inStockInfo;
      }

      public static function outStock($data): OutStockInfo|\App\Models\BaseModel {
          \DB::beginTransaction();
          $outStockInfo = OutStockInfo::create($data);
          $outStockInfo->out_stock_details()->createMany($data['out_stock_details']);
          \DB::commit();
          return $outStockInfo;
      }

  }
