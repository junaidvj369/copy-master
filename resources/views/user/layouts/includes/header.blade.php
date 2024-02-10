  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <!-- <h1 class="text-light"><a href="index.html"><span>Moderna</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{route('home')}}"><img src="{{ asset('frontend/assets/img/logo/logo.png')}}" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a></li>
          <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{route('about')}}">About</a></li>
          <li><a class="{{ request()->routeIs('services') ? 'active' : '' }}" href="{{route('services')}}">Services</a></li>
          <li><a  class="{{ request()->routeIs('contact') ? 'active' : '' }}"  href="{{route('contact')}}">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
