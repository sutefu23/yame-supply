<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
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
 * @property-read int|null $building_infos_count
 * @property-read int|null $in_stock_details_count
 * @property-read int|null $in_stock_infos_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read int|null $out_stock_details_count
 * @property-read int|null $out_stock_infos_count
 * @property-read Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserCategory $user_category
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserCategoryName($value)
 * @mixin Eloquent
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
        'user_category_id' => 'int',
    ];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
        'id',
        'name',
		'user_category_id',
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
		return $this->hasMany(BuildingInfo::class, 'builder_user_id');
	}

	public function in_stock_details()
	{
		return $this->hasMany(InStockDetail::class, 'update_user_id');
	}

	public function in_stock_infos()
	{
		return $this->hasMany(InStockInfo::class, 'produce_user_id');
	}

	public function out_stock_details()
	{
		return $this->hasMany(OutStockDetail::class, 'update_user_id');
	}

	public function out_stock_infos()
	{
		return $this->hasMany(OutStockInfo::class, 'builder_user_id');
	}
}
