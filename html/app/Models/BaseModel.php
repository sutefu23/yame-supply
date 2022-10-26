<?php

  namespace App\Models;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Auth;

  /**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model {
    /**
    * Event Hooks
    *
    * @return void
    */
    protected static function boot()
    {
      parent::boot();


      // insert
      static::creating(function ($model) {
          if (Auth::check()) {
              $model->create_user_id = Auth::id();
              $model->update_user_id = Auth::id();
          }
      });
      // update
      static::updating(function ($model) {
          if (Auth::check()) {
              $model->update_user_id = Auth::id();
          }
      });
    }
    protected $guarded = ['created_at', 'updated_at'];
    /**
    * Prepare a date for array / JSON serialization.
    *
    * @param  \DateTimeInterface  $date
    * @return string
    */
    protected function serializeDate(\DateTimeInterface $date): string {
      // datetime日付フォーマットを変更
      return $date->format('Y-m-d H:i:s');
    }
  }
