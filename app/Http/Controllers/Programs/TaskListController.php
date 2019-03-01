<?php

namespace App\Http\Controllers\Programs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TaskList;
use Carbon\Carbon;
use DataTables;
use Response;

class TaskListController extends Controller {

	public function __construct() {
    $this->middleware('auth');
    $this->title = "Task List";
    $this->uri    = "task-list";
  }

  public function index() {
    $title  = $this->title;
    $uri    = $this->uri;
	  return view('programs.task.index',compact('title','uri'));
  }

  public function total() {
  	$task = TaskList::all();
    $complete_total = TaskList::where('status', '=', 'complete')->get();
    $uncomplete_total = TaskList::where('status', '=', 'uncomplete')->get();
    $progress_total = TaskList::where('status', '=', 'on progress')->get();
    $bug_total = TaskList::where('type', '=', 'bugs')->where('status', '!=', 'complete')->get();
    $development_total = TaskList::where('type', '=', 'development')->where('status', '!=', 'complete')->get();
	  return view('programs.task.total',compact('task','complete_total','uncomplete_total','progress_total','bug_total','development_total'));
  }

  public function list(Request $request) {
    $task = TaskList::all();
    return DataTables::of($task)
      ->editColumn('created_at', function ($task) {
        $date = ($task->status == 'complete') ? '<strike>'.Carbon::parse($task->created_at)->format('d M y H:i:s').'</strike>' : Carbon::parse($task->created_at)->format('d M y H:i:s');
        return $task->created_at? with($date) : '-';
      })
       ->editColumn('subject', function ($task) {
        $subject = ($task->status == 'complete') ? '<strike>'.$task->subject.'</strike>': $task->subject;
        return $task->created_at? with($subject) : '-';
       })
       ->editColumn('desc', function ($task) {
        $desc = ($task->status == 'complete') ? '<strike>'.$task->desc.'</strike>': $task->desc;
        return $task->created_at? with($desc) : '-';
       })
       ->editColumn('created_by', function ($task) {
        $user = ($task->status == 'complete') ? '<strike>'.$task->created_by.'</strike>': $task->created_by;
        return $task->created_at? with($user) : '-';
       })
      ->editColumn('status', function ($task) {
      	if($task->status == 'uncomplete') {
      		$status = '<span class="label label-warning"><strong>Uncomplete</strong></span>';
      	} elseif ($task->status == 'on progress') {
      		$status = '<span class="label label-primary"><strong>On Progress</strong></span>';
      	} elseif ($task->status == 'complete') {
      		$status = '<span class="label label-success"><strong>Complete</strong></span>';
      	}
        return $task->status? with($status) : '-';
      })
      ->editColumn('type', function ($task) {
      	$type = ($task->type == 'bugs') ? '<span class="badge badge-danger"><strong>Bugs</strong></span>' : '<span class="badge badge-info"><strong>Development</strong></span>';
        return $task->type? with($type) : '-';
      })
      ->rawColumns(['status','type','created_at','subject','desc','created_by'])
      ->make(true);
 	}

  public function create() {
    $title  = $this->title;
    $uri    = $this->uri;
    return view('programs.task.create', compact('title','uri'));
 	}


  public function store(Request $request) {
    $this->validate($request, [
      'subject' 	=> 'required',
      'desc'    	=> 'required',
      'type'    	=> 'required',

    ]);
    $task = new TaskList();
    $task->subject  	= $request->subject;
    $task->desc     	= $request->desc;
    $task->type     	= $request->type;
    $task->status   	= 'uncomplete';
    $task->save();
    return Response::json(['responseText' => 'Success'], 200);
  }

  public function edit($id) {
    $title 				= $this->title;
    $uri          = $this->uri;
    $task         = TaskList::find($id);
    $task_type  	= $task->type;
    $task_status  = $task->status;
    return view('programs.task.edit',compact('title','task','task_type','task_status','uri'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'subject' 	=> 'required',
      'desc'    	=> 'required',
      'type'    	=> 'required',
      'status'   	=> 'required',
    ]);

    $task   					= TaskList::find($id);
    $task->subject  	= $request->subject;
    $task->desc     	= $request->desc;
    $task->type     	= $request->type;
    $task->status   	= $request->status;
    $task->save();

    return Response::json(['responseText' => 'Updated'], 200);
  }

  public function bugs_report_create() {
    return view('programs/task/bugs_report');
 	}

  public function bugs_report_store(Request $request) {
    $this->validate($request, [
      'subject' 	=> 'required',
      'desc'    	=> 'required',
    ]);

    $bugs_report = new TaskList();
    $bugs_report->subject  		= $request->subject;
    $bugs_report->desc     		= $request->desc;
    $bugs_report->type     		= 'bugs';
    $bugs_report->status   		= 'uncomplete';
    $bugs_report->save();
    return Response::json(['responseText' => 'Success'], 200);
  }

  public function destroy($id) {
    TaskList::find($id)->delete();
    return Response::json(['responseText' => 'Deleted'], 200);
  }

}
