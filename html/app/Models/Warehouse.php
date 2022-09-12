<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Warehouse
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Item[] $items
 */
class Warehouse extends BaseModel
{
	protected $table = 'Warehouse';

    protected $casts = [
        'id' => 'int',
    ];

	protected $fillable = [
        'id',
        'name'
	];

	public function items()
	{
		return $this->hasMany(Item::class, 'warehouse_id');
	}
}
