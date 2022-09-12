<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class OutStockDetail
 *
 * @property int $id
 * @property int $out_stock_id
 * @property int $item_id
 * @property int $item_quantity
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Item $item
 * @property OutStockInfo $out_stock_info
 */
class OutStockDetail extends BaseModel
{
	protected $table = 'OutStockDetail';

	protected $casts = [
		'out_stock_id' => 'int',
		'item_id' => 'int',
		'item_quantity' => 'int',
		'create_user_id' => 'int',
		'update_user_id' => 'int'
	];

	protected $fillable = [
		'out_stock_id',
		'item_id',
		'item_quantity',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'update_user_id');
	}

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_id');
	}

	public function out_stock_info()
	{
		return $this->belongsTo(OutStockInfo::class, 'out_stock_id');
	}
}
