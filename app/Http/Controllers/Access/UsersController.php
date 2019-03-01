<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;
use DataTables;
use Response;
use Carbon\Carbon;

class UsersController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title  = "Users";
    $this->uri    = 'users';
  }

	public function index() {
    $title    = $this->title;
    $uri      = $this->uri;
		return view('access.users.index', compact('title','uri'));
	}

 	public function list(Request $request) {
    $users = User::with('roles')->whereHas('roles', function($query){
      $query->where('name', '!=', 'root');
    });
		return Datatables::of($users)
    ->editColumn('active', function ($users){
      if($users->active === 1) {
        return '<span class="text-success"><i class="fas fa-lg fa-check-square"></i><span>';
      } else {
        return '<span class="text-danger"><i class="fas fa-lg fa-times-circle"></i><span>';
      }
    })
    ->editColumn('roles', function ($users) {
      return $users->roles? with($users->roles[0]->display_name) : '';})
    ->editColumn('last_login_at', function ($users) {
      return $users->last_login_at? with(Carbon::parse($users->last_login_at)->diffForHumans()) : '';})
    ->rawColumns(['active'])
    ->make(true);
 	}

 	public function create() {
    $title    = $this->title;
    $uri      = $this->uri;
    $roles    = Role::where('name', '!=', 'root')->pluck('display_name','id')->toArray();
    return view('access.users.create',compact('roles','title','uri'));
 	}

  public function store(Request $request) {
    $this->validate($request, [
      'name'      => 'required',
      'username'  => 'required|unique:users,username,NULL,id,deleted_at,NULL',
      'email'     => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
      'password'  => 'required|same:confirm-password',
      'roles'     => 'required'
    ]);
    $active           = ($request->active == 1) ? 1 : 0;
    $user             = new User();
    $user->active     = $active;
    $user->name       = $request->input('name');
    $user->username   = $request->input('username');
    $user->email      = $request->input('email');
    $user->contact    = $request->input('contact');
    $user->password   = Hash::make($request->input('password'));
    $user->photo      = 'default.jpg';
    $user->save();
    $user->attachRole($request->input('roles'));
    return Response::json(['responseText' => 'Success'], 200);
  }

  public function edit($id) {
    $title      = $this->title;
    $uri        = $this->uri;
    $user       = User::find($id);
    $roles      = Role::where('name', '!=', 'root')->pluck('display_name','id')->toArray();
    $userRole   = $user->roles_id;
    return view('access.users.edit',compact('user','roles','userRole','title','uri'));
  }

  public function update(Request $request, $id) {
    $active     = ($request->active == 1) ? 1 : 0;
    $user       = User::find($id);
    $this->validate($request, [
        'name'      => 'required',
        'username'  => 'required|unique:users,username,'.$user->id.',id,deleted_at,NULL',
        'email'     => 'required|email|unique:users,email,'.$user->id.',id,deleted_at,NULL',
        'password'  => 'same:confirm-password',
        'roles'     => 'required'
    ]);

    $user->name       = $request->input('name');
    $user->active     = $active;
    $user->username   = $request->input('username');
    $user->email      = $request->input('email');
    $user->contact    = $request->input('contact');
    if(!empty($request->input('password'))){
      $user->password = Hash::make($request->input('password'));
    }
    $user->save();
    $user->roles()->detach();
    $user->attachRole($request->input('roles'));
    return Response::json(['responseText' => 'Updated'], 200);
  }

  public function destroy($id) {
    User::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }
}
