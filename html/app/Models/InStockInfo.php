<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InStockInfo
 *
 * @property int $id
 * @property int $produce_user_id
 * @property string $produce_user_name
 * @property Carbon $import_date
 * @property string $reason
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|InStockDetail[] $in_stock_details
 * @package App\Models
 * @property-read int|null $in_stock_details_count
 */
class InStockInfo extends BaseModel
{
	protected $table = 'InStockInfo';

	protected $casts = [
		'produce_user_id' => 'int',
		'create_user_id' => 'int',
		'update_user_id' => 'int'
	];

	protected $dates = [
		'import_date'
	];

	protected $fillable = [
		'produce_user_id',
		'produce_user_name',
		'import_date',
		'reason',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'update_user_id');
	}

	public function in_stock_details()
	{
		return $this->hasMany(InStockDetail::class, 'in_stock_id');
	}
}
