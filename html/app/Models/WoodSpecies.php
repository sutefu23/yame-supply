<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WoodSpecies
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Item[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies query()
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WoodSpecies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WoodSpecies extends BaseModel
{
	protected $table = 'WoodSpecies';

    protected $casts = [
        'id' => 'int',
    ];

	protected $fillable = [
        'id',
        'name'
	];

	public function items()
	{
		return $this->hasMany(Item::class, 'wood_species_id');
	}
}
