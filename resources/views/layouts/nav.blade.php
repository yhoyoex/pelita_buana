<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
      <span class="icon-menu"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home.about') }}">Tentang<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:;">Program</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Informasi
          </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('home.blog-list') }}">Berita</a></li>
              <li><a class="dropdown-item" href="{{ route('home.announcement') }}">Pengumuman</a></li>
              {{-- <li class="dropdown">
                <a class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Others Pages</a>
                <ul class="dropdown-menu dropdown-menu1">
                  <li><a class="dropdown-item" href="notice-board.html">Notice Board</a></li>
                  <li><a class="dropdown-item" href="chairman-speech.html">Chairman Speech</a></li>
                  <li><a class="dropdown-item" href="sample-page.html">Sample Page</a></li>
                  <li><a class="dropdown-item" href="faq.html">FAQ</a></li>
                  <li><a class="dropdown-item" href="login.html">Login</a></li>
                  <li><a class="dropdown-item" href="sign-up.html">Sign Up</a></li>
                  <li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a></li>
                </ul>
              </li> --}}
            </ul>
        </li>
        <li class="nav-logo">
          <a href="{{ route('home.index') }}" class="navbar-brand"><img src="{{ asset('public/images/logo_pbs.png') }}" class="images-fluid" alt="logo"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home.galery') }}">Galeri </a>
        </li>

        <li class="nav-item">
          @guest
          <a class="nav-link" href="{{ route('login') }}">Login/Register </a>
          @else
            <a class="nav-link" href="{{ route('login') }}">Dashboard </a>
          @endguest
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home.contact') }}">Kontak </a>
        </li>
    </ul>
</div>
</nav>
