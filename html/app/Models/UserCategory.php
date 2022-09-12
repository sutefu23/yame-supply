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
 */
class UserCategory extends BaseModel
{
	protected $table = 'UserCategory';

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'id',
        'name'
	];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
