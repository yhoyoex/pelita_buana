<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;

class Role extends EntrustRole {
  use LogsActivity;

  protected $guarded = [];

  protected static $logAttributes = ['*'];
  protected static $logOnlyDirty = true;
  protected static $logName = 'Role';

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

  public function users() {
    return $this->belongsToMany('App\User');
  }

  public function permission() {
    return $this->belongsToMany('App\Permission');
  }
}
