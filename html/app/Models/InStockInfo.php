<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InStockInfo
 *
 * @property int $id
 * @property int $produce_user_id
 * @property Carbon $import_date
 * @property int $warehouse_id
 * @property string $reason
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Warehouse $warehouse
 * @property Collection|InStockDetail[] $in_stock_details
 *
 * @package App\Models
 *  * @property-read int|null $in_stock_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereCreateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereImportDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereProduceUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereUpdateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InStockInfo extends BaseModel
{
	protected $table = 'InStockInfo';

	protected $casts = [
		'produce_user_id' => 'int',
		'warehouse_id' => 'int',
		'create_user_id' => 'int',
		'update_user_id' => 'int'
	];

	protected $dates = [
		'import_date'
	];

	protected $fillable = [
		'produce_user_id',
		'import_date',
		'warehouse_id',
		'reason',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'produce_user_id');
	}

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class, 'warehouse_id');
	}

	public function in_stock_details()
	{
		return $this->hasMany(InStockDetail::class, 'in_stock_id')->with(['item']);
	}
}
