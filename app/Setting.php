<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;

class Setting extends Model {
  use LogsActivity;

  protected $table = 'settings';
  protected $fillable = ['title', 'value'];
  protected $guarded = [];
  
  protected static $logAttributes = ['title', 'value'];
  protected static $logOnlyDirty = true;
  protected static $logName = 'Settings';

  protected static function boot() {
    parent::boot();
    static::creating(function($model) {
      $user = Auth::user();
      $model->created_by = $user->name;
      $model->updated_by = $user->name;
    });
    
    static::updating(function($model) {
      $user = Auth::user();
      $model->updated_by = $user->name;
    });
    static::deleting(function($model) {
      $user = Auth::user();
      $model->deleted_by = $user->name;
      $model->save();
    }); 
  }
}
