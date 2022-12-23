<?php

  namespace App\Http\Service;

  use App\Models\BuildingInfo;
  use Illuminate\Http\Resources\Json\JsonResource;

  class BuildingInfoService {
      static function done_export($id): JsonResource {
          $build_info = BuildingInfo::with(['user','building_info_details'])::where($id);
          if(!$build_info) throw new \InvalidArgumentException("棟情報のIDが見つかりません。");

          \DB::beginTransaction();
          $build_info->update(['is_exported' => true]);
          \DB::commit();
          return new JsonResource($build_info);
      }
  }
