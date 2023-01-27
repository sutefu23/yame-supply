<?php

  namespace App\Http\Service;

  use App\Models\Item;
  use DB;
  use Illuminate\Http\Resources\Json\JsonResource;
  use LaravelIdea\Helper\App\Models\_IH_Item_C;

  class ItemService {
      /**
       * 必須数の上書き
       * @param $items
       * @return JsonResource
       */
      public static function modifyEssential($items){
          DB::beginTransaction();
          foreach ($items as $item){
              Item::whereId($item['id'])->update(['essential_quantity'    =>  $item['essential_quantity']]);
          }
          DB::commit();
      }

      /**
       * 数量の変更（プラスマイナスによる変更）
       * @param $items
       * @return array
       */
      public static function offsetQuentity($items): array {
          $updatedItems = [];
          DB::beginTransaction();
          foreach ($items as $item){
              if($item['offset_quantity']){
                  $updatedItems[] = Item::whereId($item['id'])->update(['quantity'    =>  DB::raw('quantity+'.$item['offset_quantity'])]);
              }
          }
          DB::commit();
          return $updatedItems;
      }

      /**
       * 商品一覧情報の取得
       * @return Item|array|JsonResource|\Illuminate\Support\Collection|_IH_Item_C
       */
      public static function getItemWithActiveBuildInfo(): Item|_IH_Item_C|array|\Illuminate\Support\Collection|JsonResource {
          $items = Item::with(['wood_species','unit','warehouse'])->get()->toArray();
          $build_quantities = DB::table("item")->select(['item_id as id', DB::raw('sum(item_quantity) as build_quantity')])
              ->from('BuildingInfoDetail')
              ->leftJoin('BuildingInfo', 'BuildingInfoDetail.build_info_id', '=', 'BuildingInfo.id')
              ->where('BuildingInfo.is_exported', '=', false)
              ->groupBy(['item_id'])
              ->get()->toArray();
          return array_map(function ($item, $build_quantity)
          {
              return array_merge($item, (array)$build_quantity);
          }, $items, $build_quantities);
      }
  }
