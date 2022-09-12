<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Unit
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Item[] $items
 */
class Unit extends BaseModel
{
	protected $table = 'Unit';

    protected $casts = [
        'id' => 'int',
    ];

	protected $fillable = [
        'id',
        'name'
	];

	public function items(): HasMany {
		return $this->hasMany(Item::class, 'unit_id');
	}
}
