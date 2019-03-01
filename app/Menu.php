<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Menu extends Model {

  protected $table = 'menu';
  protected $guarded = [];

  protected static function boot() {
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

    static::deleting(function($model) {
      foreach ($model->permission()->get() as $permission) {
        $permission->delete();
      }
    });
  }

  public function parent() {
		return $this->hasOne('App\Menu', 'id', 'parent_id');
	}

  public function children() {
		return $this->hasMany('App\menu', 'parent_id', 'id')->where('active', '=', 1)->orderBy('order','asc');
	}

	public static function tree() {
		return static::where('active', '=', 1)->with(implode('.', array_fill(0, 4, 'children')))->where('parent_id', '=', NULL);
	}

  public function permission() {
    return $this->hasMany('App\Permission');
  }

}
