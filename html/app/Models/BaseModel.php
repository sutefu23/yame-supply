<?php

  namespace App\Models;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Auth;

  /**
 * App\Models\BaseModel
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
                  $model->created_user_id = Auth::id();
                  $model->updated_user_id = Auth::id();
              }
          });
          // update
          static::updating(function ($model) {
              if (Auth::check()) {
                  $model->updated_user_id = Auth::id();
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
      protected function serializeDate(\DateTimeInterface $date)
      {
          // datetime日付フォーマットを変更
          return $date->format('Y-m-d H:i:s');
      }
  }
