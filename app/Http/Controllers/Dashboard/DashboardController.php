<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trans;
use App\Transx;
use Carbon\Carbon;
use DateTime;
use Auth;

class DashboardController extends Controller {

  public function __construct() {
    $this->middleware('auth');
    $this->title = "Dashboard";
    $this->uri = "dashboard";
  }

  public function index() {
    $cur_time = Carbon::now()->format('H:i');
    $current_time = DateTime::createFromFormat('H:i', $cur_time);
    $time1  = DateTime::createFromFormat('H:i', '00:00');
    $time2  = DateTime::createFromFormat('H:i', '06:59');
    $time_start   = '07:00:00';
    $time_end     = '06:59:59';
    $petugas      = Auth::user()->id;
    $title        = $this->title;
    $uri          = $this->uri;
    $date_now     = ($current_time >= $time1 && $current_time <= $time2) ? Carbon::now()->subDays(1)->toDateString().' '.$time_start : Carbon::now()->toDateString().' '.$time_start;
    $tomorow      = ($current_time >= $time1 && $current_time <= $time2) ? Carbon::now()->toDateString().' '.$time_end : Carbon::now()->addDays(1)->toDateString().' '.$time_end;
    if (Auth::user()->hasRole('AP')) {
      $p_in         = Transx::whereBetween('tgl_masuk',[$date_now,$tomorow])->orWhereBetween('tgl_keluar',[$date_now,$tomorow])->where('biaya','=',0)->sum('bayar');
      $p_out        = Transx::whereBetween('tgl_masuk',[$date_now,$tomorow])->orWhereBetween('tgl_keluar',[$date_now,$tomorow])->sum('biaya');
      $total_in     = count(Transx::where('status','=', '0')->get());
      $in_day       = count(Transx::whereBetween('tgl_masuk',[$date_now,$tomorow])->get());
      $out_day      = count(Transx::where('status','1')->whereBetween('tgl_keluar',[$date_now,$tomorow])->get());
      $k_in         = Transx::whereBetween('tgl_masuk',[$date_now,$tomorow])->where('kasir_masuk', $petugas)->sum('bayar');
      $k_out        = Transx::whereBetween('tgl_keluar',[$date_now,$tomorow])->where('kasir_keluar', $petugas)->sum('biaya');
    } else {
      $p_in         = Trans::whereBetween('tgl_masuk',[$date_now,$tomorow])->orWhereBetween('tgl_keluar',[$date_now,$tomorow])->where('biaya','=',0)->sum('bayar');
      $p_out        = Trans::whereBetween('tgl_masuk',[$date_now,$tomorow])->orWhereBetween('tgl_keluar',[$date_now,$tomorow])->sum('biaya');
      $total_in     = count(Trans::where('status','=', '0')->get());
      $in_day       = count(Trans::whereBetween('tgl_masuk',[$date_now,$tomorow])->get());
      $out_day      = count(Trans::where('status','1')->whereBetween('tgl_keluar',[$date_now,$tomorow])->get());
      $k_in         = Trans::whereBetween('tgl_masuk',[$date_now,$tomorow])->where('kasir_masuk', $petugas)->sum('bayar');
      $k_out        = Trans::whereBetween('tgl_keluar',[$date_now,$tomorow])->where('kasir_keluar', $petugas)->sum('biaya');
    }

    $income_day   = $p_in + $p_out;
    $k_income_day = $k_in + $k_out;

    $in_total = [];
    $out_total = [];
    $income_total = [];

    $months = [1,2,3,4,5,6,7,8,9,10,11,12];
    $year = date('Y');
    foreach ($months as $month) {
      if (Auth::user()->hasRole('AP')) {
        $income_in = Transx::where(function ($query) use ($year,$month) {
                      $query->whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month)->where('biaya','=',0);
                    })->orWhere(function($query) use ($year,$month) {
                      $query->whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month)->where('biaya','=',0);
                    })->sum('bayar');
        $income_out = Transx::where(function ($query) use ($year,$month) {
                      $query->whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month);
                    })->orWhere(function($query) use ($year,$month) {
                      $query->whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month);
                    })->sum('biaya');
      } else {
        $income_in = Trans::where(function ($query) use ($year,$month) {
                      $query->whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month)->where('biaya','=',0);
                    })->orWhere(function($query) use ($year,$month) {
                      $query->whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month)->where('biaya','=',0);
                    })->sum('bayar');
        $income_out = Trans::where(function ($query) use ($year,$month) {
                      $query->whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month);
                    })->orWhere(function($query) use ($year,$month) {
                      $query->whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month);
                    })->sum('biaya');
      }

      if (Auth::user()->hasRole('AP')) {
        $in_total[] = [$month,Transx::whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month)->count('id')];
        $out_total[] = [$month,Transx::whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month)->count('id')];
      } else {
        $in_total[] = [$month,Trans::whereYear('tgl_masuk',$year)->whereMonth('tgl_masuk', $month)->count('id')];
        $out_total[] = [$month,Trans::whereYear('tgl_keluar',$year)->whereMonth('tgl_keluar', $month)->count('id')];
      }
      $income_total[] = [$month,(int)$income_in + (int)$income_out];
    }
    $in_total = json_encode($in_total);
    $out_total = json_encode($out_total);
    $income_total = json_encode($income_total);
    return view('dashboard.index',compact('title','total_in','in_day','out_day','in_total','out_total','income_total','income_day','k_income_day'));
  }

}
