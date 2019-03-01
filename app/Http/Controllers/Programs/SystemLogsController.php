<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemLogsController extends Controller {

	public function __construct() {
    $this->middleware('auth');
    $this->title = "System Log";
  }

  /**
   * Display a index view of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $title = $this->title;
    return view('programs.logs.index',compact('title'));
  }

  public function getTotal() {
	  return view('programs.logs.logs_total');
  }
	
}
