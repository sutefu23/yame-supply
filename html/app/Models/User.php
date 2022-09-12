<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property int $user_category_id
 * @property string $user_category_name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|BuildingInfo[] $building_infos
 * @property Collection|InStockDetail[] $in_stock_details
 * @property Collection|InStockInfo[] $in_stock_infos
 * @property Collection|OutStockDetail[] $out_stock_details
 * @property Collection|OutStockInfo[] $out_stock_infos
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

    protected $casts = [
        'id' => 'int',
    ];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
        'id',
        'name',
		'category',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

    public function user_category()
    {
        return $this->belongsTo(UserCategory::class, 'user_category_id');
    }

	public function building_infos()
	{
		return $this->hasMany(BuildingInfo::class, 'update_user_id');
	}

	public function in_stock_details()
	{
		return $this->hasMany(InStockDetail::class, 'update_user_id');
	}

	public function in_stock_infos()
	{
		return $this->hasMany(InStockInfo::class, 'update_user_id');
	}

	public function out_stock_details()
	{
		return $this->hasMany(OutStockDetail::class, 'update_user_id');
	}

	public function out_stock_infos()
	{
		return $this->hasMany(OutStockInfo::class, 'update_user_id');
	}
}
