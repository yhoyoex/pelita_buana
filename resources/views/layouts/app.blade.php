<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'STIE Pelita Buana') }}</title>
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Simple Line Font -->
    <link href="{{ asset('public/css/simple-line-icons.css') }}" rel="stylesheet" />
    <!-- Slider / Carousel -->
    <link href="{{ asset('public/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <!-- Main CSS -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet" />
    <!-- Image Hover CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/set2.css') }}" />
</head>
<body>
  @yield('content')
  <!--============================= FOOTER =============================-->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="subscribe">
            <h3>Newsletter</h3>
            <form id="subscribeform" action="php/subscribe.php" method="post">
              <input class="signup_form" type="text" name="email" placeholder="Enter Your Email Address">
              <button type="submit" class="btn btn-warning" id="js-subscribe-btn">SUBSCRIBE</button>
              <div id="js-subscribe-result" data-success-msg="Success, Please check your email." data-error-msg="Oops! Something went wrong"></div>
              <!-- // end #js-subscribe-result -->
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="foot-logo">
            <a href="index.html">
                <img src="public/images/logo_pbs.png" class="images-fluid" alt="footer_logo">
            </a>
            <p>2019 © copyright
                <br> All rights reserved.</p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="sitemap">
              <h3>Navigation</h3>
              <ul>
                  <li><a href="about.html">About</a></li>
                  <li><a href="admission-form.html">Admissions </a></li>
                  <li><a href="admission.html">Academics</a></li>
                  <li><a href="research.html">Research</a></li>
                  <li><a href="contact.html">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tweet_box">
              <h3>Tweets</h3>
              <div class="tweet-wrap">
                <div class="tweet"></div>
                <!-- // end .tweet -->
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="address">
              <h3>Contact us</h3>
              <p><span>Address: </span> Unisco university Albany, NY, USA. 11001</p>
              <p>Email : info@unisco.com
                <br> Phone : +91 555 668 986</p>
                <ul class="footer-social-icons">
                  <li><a href="javascript:;"><i class="fa fa-facebook fa-fb" aria-hidden="true"></i></a></li>
                  <li><a href="javascript:;"><i class="fa fa-linkedin fa-in" aria-hidden="true"></i></a></li>
                  <li><a href="javascript:;"><i class="fa fa-twitter fa-tw" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
    </div>
  </footer>
      <!--//END FOOTER -->
  <script src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/js/tether.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
  <!-- Plugins -->
  <script src="{{ asset('public/js/jquery-ui-1.10.4.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.isotope.min.js') }}"></script>
  <script src="{{ asset('public/js/animated-masonry-gallery.js') }}"></script>
  <!-- Magnific popup JS -->
  <script src="{{ asset('public/js/jquery.magnific-popup.js') }}"></script>
  <script src="{{ asset('public/js/slick.min.js') }}"></script>
  <script src="{{ asset('public/js/waypoints.min.js') }}"></script>
  <script src="{{ asset('public/js/counterup.min.js') }}"></script>
  <script src="{{ asset('public/js/instafeed.min.js') }}"></script>
  <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/js/validate.js') }}"></script>
  <script src="{{ asset('public/js/tweetie.min.js') }}"></script>
  <!-- Subscribe -->
  <script src="{{ asset('public/js/subscribe.js') }}"></script>
  <!-- Script JS -->
  <script src="{{ asset('public/js/script.js') }}"></script>
</body>
</html>
