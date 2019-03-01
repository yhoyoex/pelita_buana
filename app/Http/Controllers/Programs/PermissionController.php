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

class PermissionController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title = "Hak Akses";
    $this->uri = "hak-akses";
  }

  public function index() {
    $title  = $this->title;
    $uri    = $this->uri;
    $menu   = Menu::where('active','=','1')->pluck('name','name')->toArray();
    return view('programs.permission.index',compact('title','menu','uri'));
  }

  public function list(Request $request) {
    $menu         = $request->menu;
    $permission   = ($menu) ? Permission::with('menu')->whereHas('menu', function($query) use ($menu){$query->where('name',$menu);})->get() : Permission::with('menu');
    return Datatables::of($permission)
    ->addColumn('menu', function ($permission) {
      return $permission->menu? with($permission->menu->name) : '-';
    })->make(true);
  }

  public function create() {
    $title  = $this->title;
    $uri    = $this->uri;
    $menu   = Menu::where('active','=','1')->pluck('name','id')->toArray();
    return view('programs.permission.create',compact('menu','title','uri'));
  }

  public function store(Request $request) {
    $this->validate($request, [
      'name'              => 'required|unique:permissions,name,NULL',
      'display_name'      => 'required',
      'menu'              => 'required',
    ]);

      $permission               = new Permission();
      $permission->name         = $request->name;
      $permission->display_name = $request->display_name;
      $permission->description  = $request->description;
      $permission->menu_id      = $request->menu;
      $permission->save();

      return response()->json(['responseText' => 'Success'], 200);
  }

  public function show($id) {

  }

  public function edit($id) {
    $title            = $this->title;
    $uri              = $this->uri;
    $permission       = Permission::find($id);
    $menu             = Menu::where('active','=','1')->pluck('name','id')->toArray();
    $menuPermission   = $permission->menu_id;
    return view('programs.permission.edit',compact('menu','permission','menuPermission','title','uri'));
  }

  public function update(Request $request, $id) {
    $permission = Permission::find($id);
    $this->validate($request, [
      'name'              => 'required|unique:permissions,name,'.$permission->id,
      'display_name'      => 'required',
      'menu'              => 'required',
    ]);

    $permission->name         = $request->name;
    $permission->display_name = $request->display_name;
    $permission->description  = $request->description;
    $permission->menu_id      = $request->menu;
    $permission->save();

    return response()->json(['responseText' => 'Updated'], 200);
  }

  public function destroy($id) {
    Permission::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }
}
