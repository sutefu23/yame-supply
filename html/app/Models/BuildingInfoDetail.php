<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereBuildInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereItemQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfoDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BuildingInfoDetail extends BaseModel
{
	protected $table = 'BuildingInfoDetail';

	protected $casts = [
		'build_info_id' => 'int',
		'item_id' => 'int',
		'item_quantity' => 'int',
        'create_user_id' => 'int',
        'update_user_id' => 'int'
	];

	protected $fillable = [
		'build_info_id',
		'item_id',
		'item_quantity',
        'create_user_id' => 'int',
        'update_user_id' => 'int'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_id');
	}

    public function building_info()
    {
        return $this->belongsTo(BuildingInfo::class, 'build_info_id');
    }
}
