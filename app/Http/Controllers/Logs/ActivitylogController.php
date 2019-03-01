<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\User;
use DataTables;
use Response;
use Artisan;

class ActivitylogController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title = "Logs";
    $this->uri = "activity-log";
  }

	public function index() {
    $title = $this->title;
    $uri = $this->uri;
		return view('logs.index', compact('title', 'uri'));
	}

 	public function list(Request $request) {
    $log = Activity::orderBy('created_at', 'desc');
    return Datatables::of($log)
    ->editColumn('causer_id', function ($log) {
      $user = User::where('id', $log->causer_id)->first();
      return $log->causer_id? with($user->name) : '';
    })
    ->editColumn('subject_type', function ($log) {
      return $log->subject_type? with(str_replace('App\\','',$log->subject_type).' (id:'.$log->subject_id.')') : '';
    })
    ->editColumn('created_at', function ($log) {
      return $log->created_at? with(date('M, d Y H:s:i', strtotime($log->created_at))) : '';
    })
    ->make(true);
 	}

  public function view($id) {
    $title = $this->title;
    $log = Activity::find($id);
    $log_properties = $log->properties;
    return view('logs.view',compact('log','log_properties','title'));
  }

  public function destroy($id) {
    Activity::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }

  public function clean() {
    Artisan::call("activitylog:clean");
    $statusMessage = Artisan::output('info');
    return $statusMessage;
  }
}
