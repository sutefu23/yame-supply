<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 */
class PasswordReset extends BaseModel
{
	protected $table = 'password_resets';
	public $incrementing = false;
	public $timestamps = false;

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'email',
		'token'
	];
}
