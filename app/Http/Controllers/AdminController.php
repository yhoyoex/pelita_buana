<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
      // $menu = Menu::tree()->with('permission')->get();
      $menu = Menu::tree()->with(['permission' => function($query){
      $query->where('name', 'like', '%menu%')->pluck('id','name');
      }])->orderBy('order')->get();
      return view('index',compact('menu'));
      // return Response::json($menu);
    }
}
