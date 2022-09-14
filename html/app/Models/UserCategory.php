<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCategory
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|User[] $users
 * @package App\Models
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserCategory extends BaseModel
{
	protected $table = 'UserCategory';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'user_category_id');
	}
}
