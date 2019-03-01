<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Menu;
use DataTables;
use DB;
use Response;

class RoleController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title = "Roles";
    $this->uri = 'roles';
  }

	public function index() {
    $title    = $this->title;
    $uri      = $this->uri;
		return view('access.role.index', compact('title','uri'));
	}

 	public function list(Request $request) {
    $role = Role::where('name','!=','root');
		return Datatables::of($role)->make(true);
 	}

 	public function create(){
    $title    = $this->title;
    $uri      = $this->uri;
    $menu     = Menu::tree()->with('permission')->get();
    return view('access.role.create',compact('title','menu','uri'));
  }

  public function store(Request $request) {
    $this->validate($request, [
      'name'          => 'required|unique:roles,name,NULL,id,deleted_at,NULL',
      'display_name'  => 'required|unique:permissions,display_name',
      'description'   => 'required'
    ]);
    DB::transaction(function () use ($request) {
      $role                 = new Role();
      $role->name           = $request->name;
      $role->display_name   = $request->display_name;
      $role->description    = $request->description;
      $role->save();
      $role->perms()->sync($request->permission);
      return Response::json(['responseText' => 'Success'], 200);
    });
  }

  public function edit($id) {
    $role   = Role::find($id);
    $title  = $this->title;
    $uri    = $this->uri;
    $menu   = Menu::tree()->with('permission')->get();
    $role_permission = $role->permission->pluck('id', 'id')->toArray();
    return view('access.role.edit',compact('role','menu','role_permission','title','uri'));
  }

  public function update(Request $request, $id) {
    $role = Role::findOrFail($id);
    $this->validate($request, [
      'name'          => 'required|unique:roles,name,'.$role->id.',id,deleted_at,NULL',
      'display_name'  => 'required|unique:permissions,display_name',
      'description'   => 'required'
    ]);

    DB::transaction(function () use ($role, $request, $id) {
      $role->name           = $request->name;
      $role->display_name   = $request->display_name;
      $role->description    = $request->description;
      $role->save();
      $role->perms()->sync($request->permission);
      return Response::json(['responseText' => 'Updated'], 200);
    });
  }

  public function destroy($id) {
    Role::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }
}
