<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Item
 *
 * @property int $id
 * @property int $length
 * @property int $width
 * @property int $thickness
 * @property string $raw_wood_size
 * @property int $warehouse_id
 * @property string $warehouse_name
 * @property string $memo
 * @property int $quantity
 * @property int $essential_quantity
 * @property int $unit_id
 * @property string $unit_name
 * @property int $wood_species_id
 * @property string $wood_species_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Unit $unit
 * @property Warehouse $warehouse
 * @property WoodSpecies $wood_species
 * @property Collection|BuildingInfoDetail[] $building_info_details
 * @property Collection|InStockDetail[] $in_stock_details
 * @property Collection|OutStockDetail[] $out_stock_details
 * @package App\Models
 * @property-read int|null $building_info_details_count
 * @property-read int|null $in_stock_details_count
 * @property-read int|null $out_stock_details_count
 */
class Item extends BaseModel
{
	protected $table = 'Item';

	protected $casts = [
        'id'    => 'int',
		'length' => 'int',
		'width' => 'int',
		'thickness' => 'int',
		'warehouse_id' => 'int',
		'quantity' => 'int',
		'essential_quantity' => 'int',
		'unit_id' => 'int',
		'wood_species_id' => 'int'
	];

	protected $fillable = [
        'id',
		'length',
		'width',
		'thickness',
		'raw_wood_size',
		'warehouse_id',
		'warehouse_name',
		'memo',
		'quantity',
		'essential_quantity',
		'unit_id',
		'unit_name',
		'wood_species_id',
		'wood_species_name'
	];

	public function unit()
	{
		return $this->belongsTo(Unit::class, 'unit_id');
	}

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class, 'warehouse_id');
	}

	public function wood_species()
	{
		return $this->belongsTo(WoodSpecies::class, 'wood_species_id');
	}

	public function building_info_details()
	{
		return $this->hasMany(BuildingInfoDetail::class, 'item_id');
	}

	public function in_stock_details()
	{
		return $this->hasMany(InStockDetail::class, 'item_id');
	}

	public function out_stock_details()
	{
		return $this->hasMany(OutStockDetail::class, 'item_id');
	}
}
