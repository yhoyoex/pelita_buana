<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Response;

class SettingsController extends Controller {
	
	public function __construct() {
    $this->middleware('auth');
    $this->title = "Settings";
  }

  public function index() {
    $title = $this->title;
	  return view('settings/index',compact('title'));
  }

  public function update(Request $request) {
    Setting::where('title',$request->get('name'))->update(['value' => $request->get('value')]);
    return response()->json(['responseText' => 'Success'], 200);
  }


}
