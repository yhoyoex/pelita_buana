<?php

namespace App\Http\Controllers\Backup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DataTables;
use Response;
use View;
use Artisan;

class BackupController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title = "Backup";
    $this->uri = "backup";
  }

	public function index() {
    $title = $this->title;
    $uri = $this->uri;
		return view('backup.index', compact('title','uri'));
	}

 	public function list(Request $request) {
    $data = [];
    $filesInFolder = Storage::disk('local')->files('backups');
    foreach($filesInFolder as $key => $file)
    {
      $data[$key]['name'] = str_replace("backups/", "", $file);
      $data[$key]['size'] = number_format(Storage::disk('local')->size($file) / 1048576, 2).' MB';
      $data[$key]['mime'] = Storage::disk('local')->mimeType($file);
      $data[$key]['last_modified'] = date("d-M-Y H:i:s",Storage::disk('local')->lastModified($file));
    }
		return Datatables::of($data)->make(true);
 	}

 	public function backup(){
    Artisan::call('backup:mysql-dump');
    $statusMessage = Artisan::output();
    return Response::json($statusMessage);
  }

  public function restore($name){
    Artisan::call('backup:mysql-restore', ['--filename' => $name, '--yes' => true]);
    $statusMessage = Artisan::output();
    return Response::json($statusMessage);
  }

  public function download($name) {
    return response()->download(storage_path("app/backups/{$name}"));
  }

  public function destroy($name) {
    $delete = Storage::delete('backups/'.$name);
    return Response::json(['responseText' => 'Deleted'], 200);
  }
}
