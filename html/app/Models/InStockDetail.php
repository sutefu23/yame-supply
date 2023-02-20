<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InStockDetail
 *
 * @property int $id
 * @property int $in_stock_id
 * @property int $item_id
 * @property int $item_quantity
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property InStockInfo $in_stock_info
 * @property Item $item
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereCreateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereInStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereItemQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereUpdateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InStockDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InStockDetail extends BaseModel
{
    protected $table = 'InStockDetail';

    protected $casts = [
        'in_stock_id' => 'int',
        'item_id' => 'int',
        'item_quantity' => 'int',
        'create_user_id' => 'int',
        'update_user_id' => 'int'
    ];

    protected $fillable = [
        'in_stock_id',
        'item_id',
        'item_quantity',
        'create_user_id',
        'update_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'update_user_id');
    }

    public function in_stock_info()
    {
        return $this->belongsTo(InStockInfo::class, 'in_stock_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
