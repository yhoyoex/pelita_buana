@extends('layouts.app')

@section('content')
    <!-- ========================= ABOUT IMAGE =========================-->
    <div class="about_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="index.html"><img src="images/responsive-logo.png" class="responsive-logo img-fluid" alt="responsive-logo"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.nav')
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Login</h1>
            </div>
        </div>
    </div>
</div>
<!--//END ABOUT IMAGE -->

<!--============================= Login =============================-->
<div class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
               <div id="login-overlay" class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="well">
                                      {{-- <form id="loginForm" method="POST" action="/login/" novalidate="novalidate"> --}}
                                      <form method="POST" action="{{ route('login') }}" novalidate="novalidate">
                                        @csrf
                                          <div class="form-group">
                                              <label for="username" class="control-label">Username/Email</label>
                                              <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email / Username" required autofocus>
                                              <span class="help-block"></span>
                                          </div>
                                          <div class="form-group">
                                              <label for="password" class="control-label">Password</label>
                                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                              <span class="help-block"></span>
                                          </div>
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" name="remember" id="remember"> Remember login
                                              </label>
                                          </div>
                                          <button type="submit" class="btn btn-warning" id="js-subscribe-btn">LOG IN</button>                                          </form>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--//End Login -->
  <!--============================= FOOTER =============================-->
@endsection
