<?php

namespace App\Http\Controllers\Programs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;

class CodeEditorController extends Controller {
  public function __construct() {
      $this->middleware('auth');
      $this->title = "File Editor";
  }

  public function index() {
    $title = $this->title;
    return View('programs.editor', [
      'no_header' => true,
      'no_padding' => "no-padding",
      // 'sidebar_mini' => "sidebar-mini sidebar-collapse"
    ], compact('title'));
  }

  public function get_dir(Request $request) {
    $root = base_path() . DIRECTORY_SEPARATOR;
    $postDir = rawurldecode(base_path($request->get('dir')));
    if (file_exists($postDir)) {
      $files = scandir($postDir);
      $returnDir = substr($postDir, strlen($root));
      natcasesort($files);
      if (count($files) > 2) { // The 2 accounts for . and ..
        echo "<ul class='jqueryFileTree'>";
        foreach ($files as $file) {
          $htmlRel = htmlentities($returnDir . $file);
          $htmlName = htmlentities($file);
          $ext = preg_replace('/^.*\./', '', $file);
          if (file_exists($postDir . $file) && $file != '.' && $file != '..') {
            if (is_dir($postDir . $file)) {
              echo "<li class='directory collapsed'><a rel='" . $htmlRel . "/'>" . $htmlName . "</a></li>";
            } else {
              echo "<li class='file ext_{$ext}'><a rel='" . $htmlRel . "'>" . $htmlName . "</a></li>";
            }
          }
        }
        echo "</ul>";
      }
    }
  }

  public function get_file(Request $request) {
      $filepath = $request->input('filepath');
      $data = file_get_contents(base_path($filepath));
      echo $data;
  }

  public function save_file(Request $request) {
      $filepath = $request->input('filepath');
      $filedata = $request->input('filedata');
      $data = file_put_contents(base_path($filepath), $filedata);
      return response()->json(['success' => true]);
  }
}
