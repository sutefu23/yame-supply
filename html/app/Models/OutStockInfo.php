<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OutStockInfo
 *
 * @property int $id
 * @property int|null $builder_user_id
 * @property int $warehouse_id
 * @property Carbon $export_date
 * @property string $reason
 * @property int $building_info_id
 * @property int $create_user_id
 * @property int $update_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Warehouse $warehouse
 * @property Collection|OutStockDetail[] $out_stock_details
 * @package App\Models
 * @property-read int|null $out_stock_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereBuilderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereCreateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereExportDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereUpdateUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutStockInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OutStockInfo extends BaseModel
{
    protected $table = 'OutStockInfo';

    protected $casts = [
        'builder_user_id' => 'int',
        'warehouse_id' => 'int',
        'building_info_id' => 'int',
        'create_user_id' => 'int',
        'update_user_id' => 'int'
    ];

    protected $dates = [
        'export_date'
    ];

    protected $fillable = [
        'builder_user_id',
        'warehouse_id',
        'building_info_id',
        'export_date',
        'reason',
        'create_user_id',
        'update_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'builder_user_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function building_info()
    {
        return $this->hasMany(BuildingInfo::class, 'building_info_id');
    }
    public function out_stock_details()
    {
        return $this->hasMany(OutStockDetail::class, 'out_stock_id');
    }
}
