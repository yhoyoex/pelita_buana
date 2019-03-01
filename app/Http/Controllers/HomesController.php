<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomesController extends Controller {

  public function index() {
    return view('welcome');
  }

  public function about() {
    return view('public.about');
  }

  public function program() {

  }

  public function announcement() {
    return view('public.announcement');
  }

  public function blogList() {
    return view('public.blog_list');
  }

  public function blogPost() {

  }

  public function galery() {
    return view('public.galery');
  }

  public function contact() {
    return view('public.contact');
  }
}
