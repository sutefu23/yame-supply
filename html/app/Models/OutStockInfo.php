<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OutStockInfo
 *
 * @property int $id
 * @property int|null $builder_user_id
 * @property int|null $builder_user_name
 * @property Carbon $export_date
 * @property string $reason
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|OutStockDetail[] $out_stock_details
 */
class OutStockInfo extends BaseModel
{
	protected $table = 'OutStockInfo';

	protected $casts = [
		'builder_user_id' => 'int',
		'builder_user_name' => 'int',
		'create_user_id' => 'int',
		'update_user_id' => 'int'
	];

	protected $dates = [
		'export_date'
	];

	protected $fillable = [
		'builder_user_id',
		'builder_user_name',
		'export_date',
		'reason',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'update_user_id');
	}

	public function out_stock_details()
	{
		return $this->hasMany(OutStockDetail::class, 'out_stock_id');
	}
}
