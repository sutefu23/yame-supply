<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class BuildingInfo
 *
 * @property int $id
 * @property string $field_name
 * @property int $builder_user_id
 * @property string $builder_user_name
 * @property Carbon $time_limit
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @package App\Models
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
		'builder_user_name',
		'time_limit',
		'create_user_id',
		'update_user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'update_user_id');
	}
}
