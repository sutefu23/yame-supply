<?php

  namespace App\Http\Service;

  use App\Models\InStockInfo;
  use App\Models\OutStockInfo;

  class StockService
  {
      public static function inStock($data): InStockInfo|\App\Models\BaseModel
      {
          \DB::beginTransaction();
          $inStockInfo = InStockInfo::create($data);
          $inStockInfo->in_stock_details()->createMany($data['in_stock_details']);
          $updateItems = array_map(function ($in_stock_detail) {
              return ['id'    =>  $in_stock_detail['item_id'], 'offset_quantity'  => $in_stock_detail['item_quantity']];
          }, $data['in_stock_details']);
          ItemService::offsetQuentity($updateItems);
          \DB::commit();
          return $inStockInfo;
      }

      public static function outStock($data): OutStockInfo|\App\Models\BaseModel
      {
          \DB::beginTransaction();
          $outStockInfo = OutStockInfo::create($data);
          if ($outStockInfo->building_info_id) {//出荷確定処理
              BuildingInfoService::done_export($outStockInfo->building_info_id);
          }
          $outStockInfo->out_stock_details()->createMany($data['out_stock_details']);
          $updateItems = array_map(function ($in_stock_detail) {
              return ['id'    =>  $in_stock_detail['item_id'], 'offset_quantity'  => -1 * $in_stock_detail['item_quantity']];
          }, $data['out_stock_details']);
          ItemService::offsetQuentity($updateItems);
          \DB::commit();
          return $outStockInfo;
      }
  }
