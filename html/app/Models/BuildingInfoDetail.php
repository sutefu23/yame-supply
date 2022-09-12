<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class BuildingInfoDetail
 *
 * @property int $id
 * @property int $build_info_id
 * @property int $item_id
 * @property int $item_quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Item $item
 * @package App\Models
 */
class BuildingInfoDetail extends BaseModel
{
	protected $table = 'BuildingInfoDetail';

	protected $casts = [
		'build_info_id' => 'int',
		'item_id' => 'int',
		'item_quantity' => 'int'
	];

	protected $fillable = [
		'build_info_id',
		'item_id',
		'item_quantity'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_id');
	}
}
