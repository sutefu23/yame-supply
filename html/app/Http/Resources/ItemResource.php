<?php

  namespace App\Http\Resources;

  use Illuminate\Http\Resources\Json\JsonResource;

  class ItemResource extends JsonResource
  {
      /**
       * Transform the resource into an array.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
       */
      public function toArray($request)
      {
          return [
              'length'=> $this->length,
              'width'=> $this->width,
              'thickness'=> $this->thickness,
              'raw_wood_size'=> $this->raw_wood_size,
              'warehouse_id'=> $this->warehouse_id,
              'warehouse_name'=> $this->warehouse_name,
              'memo'=> $this->memo,
              'quantity'=> $this->quantity,
              'essential_quantity'=> $this->essential_quantity,
              'unit_id'=> $this->unit_id,
              'unit_name'=> $this->unit_name,
              'wood_species_id'=> $this->wood_species_id,
              'wood_species_name'=> $this->wood_species_name,
          ];
      }
  }
