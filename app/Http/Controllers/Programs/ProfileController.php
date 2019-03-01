<?php

namespace App\Http\Controllers\Programs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Activitylog\Models\Activity;
use App\User;
use Auth;
use Hash;
use Image;
use Response;
use Carbon\Carbon;

class ProfileController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title  = "Profile";
    $this->uri    = "profile";
  }

  public function index() {
    $title  = $this->title;
    $id     = Auth::user()->id;
    $limit  = 10;
    $count  = count(Activity::where('causer_id', $id)->get());
    $log    = Activity::where('causer_id', $id)->orderBy('created_at','desc')->take($limit)->get();
  	return view('programs.profile.profile', compact('title','log','limit','count'));
  }

  public function loadMoreActivity($offset) {
    $id     = Auth::user()->id;
    $limit  = 10;
    $log    = Activity::where('causer_id', $id)->orderBy('created_at','desc')->offset($offset)->take($limit)->get();
    return view('programs/profile/load_more_activity', compact('log','offset'));
  }

  public function update_pictures(Request $request) {
    $images         = $request->file('image');
    $ext            = Input::get('ext');
    $id             = Auth::user()->id;
    $user           = Auth::user()->username;
    $name           = str_slug($id).'_'.$user.'.'.$ext;
    $path           = public_path('photo/' . $name);
    $photo          = User::find($id);
    $photo->photo   = $name;
    $photo->save();
    if($photo) {
      Image::make($images->getRealPath())->fit(200, 200)->save($path);
    };
    return response()->json($ext);
  }

  public function update_field(Request $request) {
    $id = Auth::user()->id;
    User::find($id)->update([$request->get('name') => $request->get('value')]);
    return Response::json(['responseText' => 'Success'], 200);
  }

  public function update_password() {
    return view('programs/profile/modal_password');
  }

  public function store_password(Request $request) {

    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
      return Response::json(array('errors' => ['current_password' => ['Current Password Not Match']],'message' => 'Current Password Not Match'), 422);
    }

    if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
      return Response::json(array('errors' => ['new_password' => ['New Password cannot be same as your current password. Please choose a different password']],'message' => 'New Password cannot be same as your current password. Please choose a different password'), 422);
    }

    $this->validate($request, [
      'current_password'  => 'required',
      'new_password'      => 'required|same:confirm-password|string|min:6',
    ]);

    $user           = Auth::user();
    $user->password = bcrypt($request->get('new_password'));
    $user->save();
    return Response::json(["result"=>true]);
  }
}
