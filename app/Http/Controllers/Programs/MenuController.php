<?php

namespace App\Http\Controllers\Programs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\Menu;
use App\Permission;
use DataTables;
use DB;

class MenuController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title  = "Menu";
    $this->uri    = "menu";
  }

  public function index() {
    $title  = $this->title;
    $uri    = $this->uri;
    return view('programs.menu.index',compact('title','uri'));
  }

  public function list(Request $request) {
    $menu = Menu::orderBy('order');
    return Datatables::of($menu)
     ->editColumn('active', function ($menu){
      if($menu->active === 1) {
        return '<span class="text-success"><i class="fas fa-lg fa-check-square"></i><span>';
      } else {
        return '<span class="text-danger"><i class="fas fa-lg fa-times-circle"></i><span>';
      }
    })
    ->editColumn('order', function ($menu) {
      return $menu->order? with($menu->order) : '-';})
    ->editColumn('icon', function ($menu) {
      return $menu->icon? with('<span class="text-theme"><i class="'.$menu->icon.' fa-lg"></i></span>') : '-';})
    ->addColumn('parent', function ($menu) {
      $parent = Menu::where('id',$menu->parent_id)->first();
      return $menu->parent_id? with($parent->name) : '-';})
    ->addColumn('child', function ($menu){
      if($menu->parent_id != NULL) {
        return '<span class="text-theme"><i class="fas fa-lg fa-check-square"></i><span>';
      }
    })
    ->rawColumns(['active','icon','child'])->make(true);
  }

  public function create() {
    $title  = $this->title;
    $uri    = $this->uri;
    $parent = Menu::where('parent_id',NULL)->pluck('name','id')->toArray();
    return view('programs.menu.create',compact('parent','title','uri'));
  }

  public function store(Request $request) {
    $this->validate($request, [
      'name'      => 'required',
      'url'       => 'required'
    ]);

    DB::transaction(function () use ($request) {
      $active = ($request->active == 1) ? 1 : 0;
      $name   = 'view-menu-'.str_replace(' ','-',strtolower($request->name));

      $menu                 = new Menu();
      $menu->active         = $active;
      $menu->order          = $request->order;
      $menu->name           = $request->name;
      $menu->url            = $request->url;
      $menu->parent_id      = $request->parent;
      $menu->icon           = $request->icon;
      $menu->save();

      $permission               = Permission::updateOrCreate(['name' =>  $name],['menu_id' => $menu->id]);
      $permission->name         = $name;
      $permission->display_name = 'Menu '.$request->name;
      $permission->description  = 'User can view '.strtolower($request->name).' menu';
      $permission->menu_id      = $menu->id;
      $permission->save();

      return response()->json(['responseText' => 'Success'], 200);
    });
  }

  public function show($id) {
    //
  }

  public function edit($id) {
    $title        = $this->title;
    $uri          = $this->uri;
    $menu         = Menu::find($id);
    $parent       = Menu::where('parent_id',NULL)->pluck('name','id')->toArray();
    $menuParent   = $menu->parent_id;
    return view('programs.menu.edit',compact('menu','parent','menuParent','title','uri'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'name'      => 'required',
      'url'       => 'required'
    ]);

    DB::transaction(function () use ($request, $id) {
      $menu               = Menu::find($id);
      $active             = ($request->active == 1) ? 1 : 0;
      $menu->active       = $active;
      $menu->order        = $request->order;
      $menu->name         = $request->name;
      $menu->url          = $request->url;
      $menu->parent_id    = $request->parent;
      $menu->icon         = $request->icon;
      $menu->save();

      $name = 'view-menu-'.str_replace(' ','-',strtolower($request->name));
      $permission               = Permission::firstOrCreate(['menu_id' => $id, 'name' =>  $name]);
      $permission->name         = $name;
      $permission->display_name = 'Menu '.$request->name;
      $permission->description  = 'User can view '.strtolower($request->name).' menu';
      $permission->menu_id      = $menu->id;
      $permission->save();

      return response()->json(['responseText' => 'Updated'], 200);
    });

  }

  public function destroy($id) {
    Menu::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }
}
