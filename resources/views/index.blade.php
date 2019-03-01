<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title>{{ Settings::get_settings('app_name') }}</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="Admin Template" name="description" />
  <meta content="Bayu Trisnapati" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="{{ asset('css/cssff98.css?family=Open+Sans:300,400,600,700') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap/4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/font-awesome/5.3/css/all.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('plugins/animate/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/back-end/style.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/back-end/style-responsive.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/back-end/theme/gold.css') }}" rel="stylesheet" id="theme" />
  <link href="{{ asset('plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/RowReorder/css/rowReorder.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Select/css/select.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/Highlight/css/dataTables.searchHighlight.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
  <!-- ================== END BASE CSS STYLE ================== -->

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="{{ asset('plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/52style.css') }}" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
  <!-- ================== END BASE JS ================== -->
</head>
<body>
  <div id="page-loader" class="fade show"><span class="spinner"></span></div>
  <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
    <div id="header" class="header navbar-inverse">
      <div class="navbar-header">
        <a href="{{ url('/') }}" class="navbar-brand">
            <span><strong class="text-theme">{{ Settings::get_settings('app_name') }}</strong></span>
        </a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      </div>
      <ul class="navbar-nav navbar-right">
        <li class="dropdown">
          <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
            <i class="fa fa-bell"></i>
            @if(count(auth()->user()->unreadNotifications) > 0)
              <span class="label">{{count(auth()->user()->unreadNotifications)}}</span>
            @endif
          </a>
          <ul class="dropdown-menu media-list dropdown-menu-right">
              <li class="dropdown-header">NOTIFIKASI <span class="badge badge-danger badge-square">{{count(auth()->user()->unreadNotifications)}}</span></li>
              @foreach(auth()->user()->Notifications->take(8) as $notification)
                <li class="media">
                  <a href="{{URL($notification->data['uri'])}}" onclick="read_notification({{ $notification }})">
                    <div class="media-left"><i class="fas fa-envelope fa-lg text-primary"></i></div>
                      <div class="media-body">
                        @if($notification->type == 'App\Notifications\Tembusan')
                          @if($notification->read_at == null)
                            <h6 class="media-heading">Surat Masuk <span class="text-danger">(Belum dibaca)</span></h6>
                            <div class="text-muted f-s-11">No. Surat : {{$notification->data['no_surat']}}</div>
                          @else
                            <h6 class="media-heading">Surat Masuk</h6>
                            <div class="text-muted f-s-11">No. Surat : {{$notification->data['no_surat']}}</div>
                          @endif
                        @endif
                      </div>
                  </a>
                </li>
              @endforeach
          </ul>
        </li>
        <li class="dropdown navbar-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('photo/'.Auth::user()->photo) }}" alt="" />
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
            {{-- <b><span class="text-theme" id="date-part">&nbsp;</span></b> --}}
            {{-- <span> - </span> --}}
            {{-- <span class="text-theme" id="time-part">&nbsp;</span> --}}
            {{-- <b class="caret"></b> --}}
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('profile') }}" class="dropdown-item" data-toggle="ajax">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item text-red-lighter"></i> Log Out</a>
          </div>
        </li>
      </ul>
    </div>

    <div id="sidebar" class="sidebar">
      <div data-scrollbar="true" data-height="100%">
        <ul class="nav" id='nav_profile'>
          <li class="nav-profile">
            <a href="javascript:;" data-toggle="nav-profile">
              <div class="cover with-shadow"></div>
              <div class="image">
                <img src="{{ asset('photo/'.Auth::user()->photo) }}" alt="" />
              </div>
              <div class="info">
                <b class="caret pull-right"></b>
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->roles[0]->display_name }}</small>
              </div>
            </a>
          </li>
          <li>
            <ul class="nav nav-profile">
              <li><a href="{{ route('profile') }}" data-toggle="ajax"><i class="fas fa-user"></i> Profile</a></li>
              <li><a href="javascript:;" onclick="bugs_report()"><i class="fas fa-bug"></i> Lapor Masalah System</a></li>
              @ability('root','')
              <li><a href="{{ route('menu') }}" data-toggle="ajax"><i class="fas fa-align-justify"></i> Menu</a></li>
              <li><a href="{{ route('hak-akses') }}" data-toggle="ajax"><i class="fas fa-shield-alt"></i> Hak Akses</a></li>
              <li><a href="{{ route('task-list') }}" data-toggle="ajax"><i class="fas fa-edit"></i> Task List</a></li>
              {{-- <li><a href="{{ route('editor') }}" data-toggle="ajax"><i class="fa fa-code"></i> File Editor</a></li> --}}
              {{-- <li><a href="{{ route('system-logs') }}" data-toggle="ajax"><i class="fas fa-info-circle"></i> System Logs</a></li> --}}
              @endability
              {{-- <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li> --}}
            </ul>
          </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
          <li class="nav-header">Navigation</li>
          @foreach($menu as $key => $item)
            @ability('root', $item->permission[0]->name)
            @if (count($item->children))
              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  <i class="{{ $item->icon }}"></i>
                  <span>{{ $item->name }}</span>
                </a>
                <ul class="sub-menu">
                  @foreach($item->children as $children)
                  @ability('root', $children->permission[0]->name)
                  <li><a href="@if($children->url != NULL) {{ url($children->url) }} @else javascript:; @endif" data-toggle="ajax">{{ $children->name }}</a></li>
                  @endability
                  @endforeach
                </ul>
              </li>
            @else
              <li><a href="@if($item->url != NULL) {{ url($item->url) }} @else javascript:; @endif" data-toggle="ajax"><i class="{{ $item->icon }}"></i> <span>{{ $item->name }}</span></a></li>
            @endif
            @endability
          @endforeach
          <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="sidebar-bg"></div>
    <div id="content" class="content"></div>
    <div class="modal fade" id="modal_bugs_report" tabindex="-1" aria-labelledby="modal_bugs_report" aria-hidden="true"></div>
    <div id="footer" class="footer">
      &copy; {{ date('Y') }} <a href="javascript:;" target="_blank"><b class="text-theme" >{{ Settings::get_settings('app_company') }}</a></b> All Rights Reserved
    </div>
    <div class="theme-panel theme-panel-lg">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				<h5 class="m-t-0">Theme Setting</h5>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Header Styling</div>
					<div class="col-md-6">
						<select name="header-styling" class="form-control form-control-sm">
							<option value="1">default</option>
							<option value="2">inverse</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Header</div>
					<div class="col-md-6">
						<select name="header-fixed" class="form-control form-control-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Styling</div>
					<div class="col-md-6">
						<select name="sidebar-styling" class="form-control form-control-sm">
							<option value="1">default</option>
							<option value="2">grid</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar</div>
					<div class="col-md-6">
						<select name="sidebar-fixed" class="form-control form-control-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Gradient</div>
					<div class="col-md-6">
						<select name="content-gradient" class="form-control form-control-sm">
							<option value="1">disabled</option>
							<option value="2">enabled</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Content Styling</div>
					<div class="col-md-6">
						<select name="content-styling" class="form-control form-control-sm">
							<option value="1">default</option>
							<option value="2">black</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Direction</div>
					<div class="col-md-6">
						<select name="direction" class="form-control form-control-sm">
							<option value="1">LTR</option>
							<option value="2">RTL</option>
						</select>
					</div>
				</div>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-12">
						<a href="javascript:;" class="btn btn-inverse btn-block btn-rounded" data-click="reset-local-storage"><b>Reset Local Storage</b></a>
					</div>
				</div>
			</div>
		</div>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="{{ asset('plugins/jquery/jquery-3.3.1.min.js') }}"></script>
  {{-- <script src="{{ asset('plugins/jquery/jquery-migrate-1.4.1.min.js') }}"></script> --}}
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-loading-overlay/extras/loadingoverlay_progress/loadingoverlay_progress.min.js') }}"></script>
  <script src="{{ asset('js/back-end/theme/default.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js') }}"></script>
  <!--[if lt IE 9]>
    <script src="{{ asset('crossbrowserjs/html5shiv.js') }}"></script>
    <script src="{{ asset('crossbrowserjs/respond.min.js') }}"></script>
    <script src="{{ asset('crossbrowserjs/excanvas.min.js') }}"></script>
  <![endif]-->
  <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('plugins/jquery-loading-overlay/src/loadingoverlay.min.js') }}"></script>
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  {{-- <script src="{{ asset('plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.js') }}"></script> --}}
  <script src="{{ asset('js/back-end/apps.min.js') }}"></script>

  <script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}"></script>
  <script src="{{ asset('plugins/es6-promise/es6-promise.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>

  <script src="{{ asset('plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/RowReorder/js/dataTables.rowReorder.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Select/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/ColVis/js/buttons.colVis.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/Highlight/js/dataTables.searchHighlight.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>
  <!-- ================== END BASE JS ================== -->

  <script>
    $(document).ajaxError(function(event, jqxhr, settings, exception) {
      if (exception == 'Unauthorized') {
        var redirect = confirm("You're session has expired. Would you like to be redirected to the login page?");
        if (redirect) {
            window.location = '/logout';
        }
      }
    });
    // $.sessionTimeout({
    //     message: 'You\'re being timed out due to inactivity. Please choose to stay connected or to logout. Otherwise, you will logged out automatically.',
    //     logoutUrl: '/logout',
    //     warnAfter: 5100000,
    //     redirAfter: 5400000,
    //     countdownMessage: '<strong>Logout in {timer}.</strong>',
    //     countdownSmart: true,
    //   });
    $(document).ajaxStart(function(){
      $("body").addClass("page-content-loading"),$("#content").append('<div id="page-content-loader"><span class="spinner"></span></div>')
    });

    $(document).ajaxStop(function(){
      $("#page-content-loader").remove(),$("body").removeClass("page-content-loading");
    });

    $(document).ready(function() {
      App.init({
          ajaxMode: true,
          ajaxDefaultUrl: '{{ route('dashboard') }}',
          ajaxType: 'GET',
          ajaxDataType: 'html'
      });

      $('.modal').draggable({
        handle: ".modal-header"
      });

      setInterval(function() {
          var momentNow = moment();
          $('#date-part').html(momentNow.format('dddd').substring(0,3) + ' ' + momentNow.format('DD MMM YY'));
          $('#time-part').html(momentNow.format('hh:mm:ss A'));
      }, 100);
      if ('{{ session('status') }}') {
        $.gritter.add({title:"Welcome Back, {{ Auth::user()->name }}!",text:"Last login : {{ \Carbon\Carbon::parse(Auth::user()->previous_visit_at)->diffForHumans() }}<br> Last login IP : {{ Auth::user()->previous_visit_ip }}",image:"{{ asset('photo/'.Auth::user()->photo) }}"});
      };
    });
    function bugs_report() {
      $.ajax({
        type:"GET",
        url: "bugs-report/create",
        success: function(res) {
          $('#modal_bugs_report').html(res);
          $('#modal_bugs_report').modal('show');
        }
      });
    }

    function read_notification(data) {
      id = data.id;
      $.ajax({
        type:"GET",
        url: "notification/read/" + id,
        success: function(res) {
          return true;
        }
      });
    }

    function save_bugs_report(){
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
        type:"POST",
        url:'bugs-report/store',
        data:$('#form-bugs-report').serialize(),
        dataType: 'json',
        success: function(data){
          $('#modal_bugs_report').modal('hide');
          $.gritter.add({title:"Info masalah system ditambahkan!",text:"Anda berhasil memposting masalah system. Terima Kasih"});
          reload_data();
        },
        error: function(data){
          $('#alert').html('');
          if(data.status == 422) {
            $('.alert').removeAttr('hidden');
            for (var error in data.responseJSON.errors) {$('#alert').append(data.responseJSON.errors[error]+'<br>')};
          } else {
            error = data.responseJSON.message;
            $('#alert').append('Error, Terjadi kesalahan sytem, harap hubungi administrator' + ' (' + error + ')');
          }
        }
      })
    }
  </script>
</body>
</html>
