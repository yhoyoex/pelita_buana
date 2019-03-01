<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;

class Permission extends EntrustPermission {
  use LogsActivity;
  
  protected $guarded = [];
  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;
  protected static $logName = 'Permission';

  public static function boot() {
    parent::boot();

    static::creating(function($model) {
      $user = Auth::user();
      $model->created_by = $user->id;
      $model->updated_by = $user->id;
    });

    static::updating(function($model) {
      $user = Auth::user();
      $model->updated_by = $user->id;
    });
  }

  public function menu() {
    return $this->belongsTo('App\Menu');
  }

  public function roles() {
    return $this->belongsToMany('App\Role');
  }
}
