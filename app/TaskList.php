<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TaskList extends Model {

	protected $table = 'task_list';
  protected $guarded = [];

  protected static function boot() {
    parent::boot();
    static::creating(function($model)  {
      $user = Auth::user();    
      $model->created_by = $user->name;
      $model->updated_by = $user->name;
    });

    static::updating(function($model)  {
      $user = Auth::user();
      $model->updated_by = $user->name;
    });

    static::deleting(function($model) {
      $user = Auth::user();
      $model->deleted_by = Auth::user()->name;
      $model->save();
    });
  }
}
