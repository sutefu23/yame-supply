<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BuildingInfo
 *
 * @property int $id
 * @property string $field_name
 * @property int $builder_user_id
 * @property Carbon $time_limit
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereBuilderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereCreateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereTimeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereUpdateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BuildingInfo extends BaseModel
{
	protected $table = 'BuildingInfo';

	protected $casts = [
		'builder_user_id' => 'int',
		'create_user_id' => 'int',
		'update_user_id' => 'int'
	];

	protected $dates = [
		'time_limit'
	];

	protected $fillable = [
		'field_name',
		'builder_user_id',
		'time_limit',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'update_user_id');
	}

    public function building_info_details()
    {
        return $this->hasMany(BuildingInfoDetail::class, 'build_info_id')->with(['item']);
    }
}
