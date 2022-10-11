<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Warehouse
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|InStockInfo[] $in_stock_infos
 * @property Collection|Item[] $items
 * @property Collection|OutStockInfo[] $out_stock_infos
 * @package App\Models
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Warehouse extends BaseModel
{
	protected $table = 'Warehouse';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function in_stock_infos()
	{
		return $this->hasMany(InStockInfo::class, 'warehouse_id');
	}

	public function items()
	{
		return $this->hasMany(Item::class, 'warehouse_id');
	}

	public function out_stock_infos()
	{
		return $this->hasMany(OutStockInfo::class, 'warehouse_id');
	}
}
