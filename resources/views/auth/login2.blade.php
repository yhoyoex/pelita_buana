<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>{{ Settings::get_settings('app_name') }} | Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Fifty Two Admin Panel" name="description" />
	<meta content="Bayu Trisnapati" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="{{asset('css/cssff98.css?family=Open+Sans:300,400,600,700')}}" rel="stylesheet" />
	<link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
	<link href="{{asset('plugins/bootstrap/4.1.3/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('plugins/font-awesome/5.3/css/all.min.css')}}" rel="stylesheet" />
	<link href="{{asset('plugins/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{asset('css/back-end/style.min.css')}}" rel="stylesheet" />
	<link href="{{asset('css/back-end/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{asset('css/back-end/theme/gold.css')}}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('plugins/pace/pace.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url({{asset('img/login-bg/Black-And-Gold-Background-3.jpg')}})"></div>
				<div class="news-caption">
					{{-- <h4 class="caption-title"><b class="text-theme">{{ Settings::get_settings('app_name') }}</b> {{ Settings::get_settings('app_desc') }}</h4> --}}
          <img width="300px" src="{{asset('logo/logo_white.png')}}" class="img-fluid"/>
					<p>{{ Settings::get_settings('app_desc') }}</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin login-header -->
				<div class="login-header">
					<div class="brand text-center">
            <img src="{{asset('logo/logo_black.png')}}" class="img-fluid"/>
						<small>{{ Settings::get_settings('app_desc') }}</small>
            <div style="font-size:20px;margin-bottom:-15px;margin-top:50px" class="text-left"><b class="text-theme">Login</b></div>
					</div>
					{{-- <div class="icon"> --}}
						{{-- <i class="fa fa-sign-in"></i> --}}
					{{-- </div> --}}
				</div>
				<!-- end login-header -->
				<!-- begin login-content -->
				<div class="login-content">
					<form method="POST" action="{{ route('login') }}">
            @csrf
						<div class="form-group m-b-15">
              <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email / Username" required autofocus>
						</div>
						<div class="form-group m-b-15">
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
						</div>
						<div class="checkbox checkbox-css m-b-30">
							<input type="checkbox" id="remember_me_checkbox" value="" />
							<label for="remember_me_checkbox">Remember Me</label>
						</div>
						<div class="login-buttons">
							<button type="submit" class="btn btn-theme btn-block btn-lg">Masuk</button>
						</div>
						<br>
						@if(session()->has('errors'))
							<span class="help-block text-center">
								@foreach($errors->all() as $error)
										<strong><span class="text-danger">{{ $error }}</span></strong><br>
								@endforeach
							</span>
            @endif
						<hr />
						<p class="text-center text-grey-darker">
							&copy; {{ Settings::get_settings('app_company') }} All Right Reserved {{ date('Y') }}
						</p>
					</form>
				</div>
				<!-- end login-content -->
			</div>
			<!-- end right-container -->
		</div>
		<!-- end login -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js')}}"></script>
	<!--[if lt IE 9]>
		<script src="{{asset('crossbrowserjs/html5shiv.js')}}"></script>
		<script src="{{asset('crossbrowserjs/respond.min.js')}}"></script>
		<script src="{{asset('crossbrowserjs/excanvas.min.js')}}"></script>
	<![endif]-->
	<script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('plugins/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('js/back-end/theme/default.min.js')}}"></script>
	<script src="{{asset('js/back-end/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
