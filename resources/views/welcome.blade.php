@extends('layouts.app')

@section('content')
    <!--============================= HEADER =============================-->
    <header>
      <div class="container nav-menu">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('home.index') }}"><img src="{{ asset('public/images/responsive-logo.png') }}" class="responsive-logo images-fluid" alt="responsive-logo"></a>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.nav')
          </div>
        </div>
      </div>
    <div class="slider_images">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block" src="{{ asset('public/images/slider.jpg') }}" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <div class="slider_title">
                            <h1>Creative Thinking &amp; Innovation</h1>
                            <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                            <div class="slider-btn">
                                <a href="#" class="btn btn-default">SEE Programs</a>
                                <a href="#" class="btn btn-default">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block" src="{{ asset('public/images/slider-2.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-md-block">
                        <div class="slider_title">
                            <h1>We foster wisdom</h1>
                            <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                            <div class="slider-btn">
                                <a href="#" class="btn btn-default">SEE Programs</a>
                                <a href="#" class="btn btn-default">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block" src="{{ asset('public/images/slider-3.jpg') }}" alt="Third slide">
                    <div class="carousel-caption d-md-block">
                        <div class="slider_title">
                            <h1>Campus life @ Unisco</h1>
                            <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                            <div class="slider-btn">
                                <a href="campus-life.html" class="btn btn-default">Campus Life</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <i class="icon-arrow-left fa-slider" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <i class="icon-arrow-right fa-slider" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</header>
<!--//END HEADER -->
<!--============================= ABOUT =============================-->
<section class="clearfix about">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Selamat Datang</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
              <br>standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
              <br> type specimen book. It has survived not only five centuries</p>
              <img src="{{ asset('public/images/welcom_sign.png') }}" class="images-fluid" alt="welcom-img">
            </div>
          </div>
        </div>
    </section>
    <!--//END ABOUT -->
    <!--============================= Notice board =============================-->
    <section class="our_courses">
    <div class="notice">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="contact-title">
                <h2>Pengumuman</h2>
              </div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="event_date">
                <div class="event-date-wrap">
                  <p>06</p>
                  <span>Nov.17</span>
                </div>
              </div>
              <div class="date-description">
                <h3>Timetable Mid of Semester Examination July 2018</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                <hr class="event_line">
              </div>
              <div class="event_date">
                <div class="event-date-wrap">
                  <p>06</p>
                  <span>Nov.17</span>
                </div>
              </div>
              <div class="date-description">
                <h3>University Admissions 2018-19</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting industry</a>. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                </p>
                <hr class="event_line">
              </div>
              <div class="event_date">
                <div class="event-date-wrap">
                  <p>10</p>
                  <span>Nov.17</span>
                </div>
              </div>
              <div class="date-description">
                <h3>Important Notice for all final Semester Students</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
              </div>
            </div>
          </div>
          <hr />
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-default btn-courses">Semua Pengumuman</a>
            </div>
        </div>
    </div>
  </section>
    <!--//End Notice board -->

    <!--============================= OUR BLOG =============================-->
    <section class="event">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Berita</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <a href="blog-post.html" class="home_blog_link">
                        <div class="blog-img_box">
                            <img src="public/images/blog-img_1.jpg" class="images-fluid blog_display" alt="blog-img">
                            <div class="blogtitle">
                                <h3>Eestibulum sodales</h3>
                                <i class="icon-user fa-common" aria-hidden="true"></i>
                                <p>by: admin</p>
                                <i class="icon-speedometer fa-common" aria-hidden="true"></i>
                                <p>9- Nov-2016</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="blog-post.html" class="home_blog_link">
                        <div class="blog-img_box">
                            <img src="public/images/blog-img_2.jpg" class="images-fluid blog_display" alt="blog-img">
                            <div class="blogtitle">
                                <h3>Variations of passages</h3>
                                <i class="icon-user fa-common" aria-hidden="true"></i>
                                <p>by: admin</p>
                                <i class="icon-speedometer fa-common" aria-hidden="true"></i>
                                <p>9- Nov-2016</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="blog-post.html" class="home_blog_link">
                        <div class="blog-img_box">
                            <img src="public/images/blog-img_3.jpg" class="images-fluid blog_display" alt="blog-img">
                            <div class="blogtitle">
                                <h3>Lorem Ipsum passage</h3>
                                <i class="icon-user fa-common" aria-hidden="true"></i>
                                <p>by: admin</p>
                                <i class="icon-speedometer fa-common" aria-hidden="true"></i>
                                <p>9- Nov-2016</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="blog-post.html" class="home_blog_link">
                        <div class="blog_hide">
                            <i class="icon-link" aria-hidden="true"></i>
                            <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been dummy...</p>
                            <div class="blogtitle-link">
                                <i class="icon-user fa-common" aria-hidden="true"></i>
                                <p>by: admin</p>
                                <i class="icon-speedometer fa-common" aria-hidden="true"></i>
                                <p>9- Nov-2016</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="blog-post.html" class="home_blog_link">
                        <div class="blog-img_box">
                            <div class="blog-video">
                                <div class="blog-play_btn"> <img src="public/images/play-btn.png" alt="play-btn"> </div>
                                <img src="public/images/blog-img_4.jpg" class="images-fluid blog_display" alt="blog-img">
                            </div>
                            <!-- // end .blog-video -->
                            <div class="blogtitle">
                                <h3>Nam libero tempore</h3>
                                <i class="icon-user fa-common" aria-hidden="true"></i>
                                <p>by: admin</p>
                                <i class="icon-speedometer fa-common" aria-hidden="true"></i>
                                <p>9- Nov-2016</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="btn btn-default btn-courses">Semua Berita</a>
                </div>
            </div>
        </div>
    </section>
    <!--//END OUR BLOG -->
    <!--============================= DETAILED CHART =============================-->
    <div class="detailed_chart">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom">
                    <div class="chart-img">
                        <img src="public/images/chart-icon_1.png" class="images-fluid" alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter">39</span> Teachers
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 chart_bottom chart_top">
                    <div class="chart-img">
                        <img src="public/images/chart-icon_2.png" class="images-fluid" alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter">2600</span> Students
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 chart_top">
                    <div class="chart-img">
                        <img src="public/images/chart-icon_3.png" class="images-fluid" alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter">56</span> Courses
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="chart-img">
                        <img src="public/images/chart-icon_4.png" class="images-fluid" alt="chart_icon">
                    </div>
                    <div class="chart-text">
                        <p><span class="counter">13</span> Years Exp.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//END DETAILED CHART -->
    <!--============================= OUR COURSES =============================-->
    <section class="our_courses">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Program Study</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="courses_box mb-5">
                        <div class="course-img-wrap">
                            <img src="{{ asset('public/images/courses_1.jpg') }}" class="images-fluid" alt="courses-img">
                            <div class="courses_box-img">
                                <div class="courses-link-wrap">
                                    <a href="course-detail.html" class="course-link"><span>course Details </span></a>
                                    <a href="admission-form.html" class="course-link"><span>Join today </span></a>
                                </div>
                                <!-- // end .courses-link-wrap -->
                            </div>
                        </div>
                        <!-- // end .course-img-wrap -->
                        <div class="courses_icon">
                            <img src="{{ asset('public/images/plus-icon.png') }}" class="images-fluid close-icon" alt="plus-icon">
                        </div>
                        <a href="course-detail.html" class="course-box-content">
                            <h3>Biochemistry</h3>
                            <p>When an unknown printer took a galley...</p>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="courses_box mb-5">
                        <div class="course-img-wrap">
                            <img src="public/images/courses_2.jpg" class="images-fluid" alt="courses-img">
                            <div class="courses_box-img">
                                <div class="courses-link-wrap">
                                    <a href="course-detail.html" class="course-link"><span>course Details </span></a>
                                    <a href="admission-form.html" class="course-link"><span>Join today </span></a>
                                </div>
                                <!-- // end .courses-link-wrap -->
                            </div>
                        </div>
                        <!-- // end .course-img-wrap -->
                        <div class="courses_icon">
                            <img src="{{ asset('public/images/plus-icon.png') }}" class="images-fluid close-icon" alt="plus-icon">
                        </div>
                        <a href="course-detail.html" class="course-box-content">
                            <h3>History</h3>
                            <p>When an unknown printer took a galley...</p>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="courses_box mb-5">
                        <div class="course-img-wrap">
                            <img src="{{ asset('public/images/courses_3.jpg') }}" class="images-fluid" alt="courses-img">
                            <div class="courses_box-img">
                                <div class="courses-link-wrap">
                                    <a href="course-detail.html" class="course-link"><span>course Details </span></a>
                                    <a href="admission-form.html" class="course-link"><span>Join today </span></a>
                                </div>
                                <!-- // end .courses-link-wrap -->
                            </div>
                        </div>
                        <!-- // end .course-img-wrap -->
                        <div class="courses_icon">
                            <img src="{{ asset('public/images/plus-icon.png') }}" class="images-fluid close-icon" alt="plus-icon">
                        </div>
                        <a href="course-detail.html" class="course-box-content">
                            <h3>Human Sciences</h3>
                            <p>When an unknown printer took a galley...</p>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="courses_box mb-5">
                        <div class="course-img-wrap">
                            <img src="{{ asset('public/images/courses_4.jpg') }}" class="images-fluid" alt="courses-img">
                            <div class="courses_box-img">
                                <div class="courses-link-wrap">
                                    <a href="course-detail.html" class="course-link"><span>course Details </span></a>
                                    <a href="admission-form.html" class="course-link"><span>Join today </span></a>
                                </div>
                                <!-- // end .courses-link-wrap -->
                            </div>
                        </div>
                        <!-- // end .course-img-wrap -->
                        <div class="courses_icon">
                            <img src="public/images/plus-icon.png" class="images-fluid close-icon" alt="plus-icon">
                        </div>
                        <a href="course-detail.html" class="course-box-content">
                            <h3>Earth Sciences</h3>
                            <p>When an unknown printer took a galley...</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="btn btn-default btn-courses">Semua Program Study</a>
                </div>
            </div>
        </div>
    </section>
    <!--//END OUR COURSES -->
    {{-- <!--============================= EVENTS =============================-->
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Upcoming Events</h2>
                    <div class="event-img">
                        <span class="event-img_date">06-Nov-17</span>
                        <img src="public/images/upcoming-event-img.jpg" class="images-fluid" alt="event-img">
                        <div class="event-img_title">
                            <h3>Event Heading</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>Important Dates</h2>
                    <div class="event-date-slide">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>06</p>
                                        <span>Nov.17</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Eestibulum sodales metus.</h3>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book ...</p>
                                    <hr class="event_line">
                                </div>
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>10</p>
                                        <span>Nov.17</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Integer faucibus nulla a ligula.</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever...</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>05</p>
                                        <span>Oct.17</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Eestibulum sodales metus.</h3>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book ...</p>
                                    <hr class="event_line">
                                </div>
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>06</p>
                                        <span>Nov.17</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Integer faucibus nulla a ligula.</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever...</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>06</p>
                                        <span>Sep.18</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Eestibulum sodales metus.</h3>
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book ...</p>
                                    <hr class="event_line">
                                </div>
                                <div class="event_date">
                                    <div class="event-date-wrap">
                                        <p>06</p>
                                        <span>Mar.17</span>
                                    </div>
                                </div>
                                <div class="date-description">
                                    <h3>Integer faucibus nulla a ligula.</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//END EVENTS --> --}}
    <!--============================= Instagram Feed =============================-->
    {{-- <div id="instafeed"></div> --}}
    <!--//END Instagram feed JS -->
    @endsection
