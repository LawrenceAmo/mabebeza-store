<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fadaeco') }}</title>
{{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}"> --}}


{{-- <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
<link rel="stylesheet" href="{{ asset('mdb/css/quick-website.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('mdb/css/admin.layout.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
         <script src="{{ asset('mdb/js/vue.js') }}"></script>
<link sync rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

 
        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
 
   <style>
      body {
                font-family: 'Nunito', sans-serif;
            }
    .top-navbar{
      position: fixed;
      top: 0px;
      width: 100%;
      margin: 0px;
      z-index: 1;
      background-color: whitesmoke
    }
   </style>
    </head>
    <body>
      
      <nav id="navbar-scroll" class="  navbar navbar-expand-lg navbar-white top-navbar   " style="z-index:1000;">
      <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="/">
       
          <img
            alt="fadaeco"
                          height="35"
            src="{{ asset('fadaeco.png') }}"
            id="navbar-logo"
            class="animate fadeInLeft"
          />
        </a>
        <!-- Toggler -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse  d-flex justify-content-end" id="navbarCollapse">
          <ul class="navbar-nav mt-4 mt-lg-0 ml-auto ">
            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
            
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html#services">Services</a> 
            </li>    <li class="nav-item">
              <a class="nav-link" href="index.html#ecommerce">Pricing</a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link" href="{{route('contact-us')}}">Contact</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="about.html">About Us</a>
            </li> -->
            
 @if (Route::has('login'))
                     @auth
                        <li class="nav-item"><a href="{{ url('/portal') }}" class=" nav-link">My Portal</a> </li>  
                    @else
                      <li class="nav-item    ">
                        <a href="{{ route('login') }}" class="  nav-link">Log in</a>
                      </li>  

                      <li class="nav-item"> 
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                      </li>  
                     @endauth
             @endif           
          </ul>
          
        </div>
      </div>
      </nav>
        <div class="  text-gray font-weight-normal antialiased">
            {{ $slot }}
        </div>
          <footer class="position-relative" id="footer-main pt-0">
      <div class="footer pt-lg-7 footer-dark bg-dark">
        <!-- SVG shape -->
        <div
          class="shape-container shape-line shape-position-top shape-orientation-inverse"
        >
           
        </div>
        <!-- Footer -->
        <div class="container pt-4">
          <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <!-- Theme's logo -->
              <a href="index.html ">
                <img
                  class="w-50"
                  alt="Image placeholder"
                  src="{{ asset('fadaeco-white.png') }}"
                  id="footer-logo"
                />
              </a>
              <!-- Webpixels' mission -->
              <p class="mt-4 text-sm opacity-8 pr-lg-4">
                Bring your business online and make more sales than before. At
                Fadaeco we will build and intergrate your business with our top
                services. From idea to success.
              </p>
             
            </div>
            <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0  ">
              <h6 class="heading mb-3">Account</h6>
              <ul class="list-unstyled">
                <li><a href="admin/profile.html">Profile</a></li>
                <li><a href="admin/company.html">Settings</a></li>
                <li><a href="admin/plans.html">My Plan</a></li>
              </ul>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
              <h6 class="heading mb-3">About</h6>
              <ul class="list-unstyled">
                <li><a href="index.html#ecommerce">Services</a></li>
                <li><a href="index.html#ecommerce">Pricing</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
              <h6 class="heading mb-3">Company</h6>
              <ul class="list-unstyled">
                <li><a href="contact.html#departments">Information</a></li>
                <li><a href="contact.html#departments">Help center</a></li>
                <li><a href="contact.html#departments">Support</a></li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <!-- Social -->
              <ul class="nav mt-4  ">
                <li class="nav-item">
                  <a class="nav-link" href="https://web.whatsapp.com/" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" target="_blank" href="https://www.linkedin.com/in/amomad/" >
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://facebook.com/fadaeco.sa" target="_blank">
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-7  d-flex flex-column justify-content-center">
              <div class="d-flex justify-content-between m-0">
                <div class="px-3">
                  <img src="{{ asset('fadaeco-white.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('fadaeco-white.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('fadaeco-white.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('fadaeco-white.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('fadaeco-white.png') }}" class="" height="25" alt="">
                </div>
              </div>
            </div>
          </div>
          <hr class="divider divider-fade divider-dark my-4" />
          <div class="row align-items-center justify-content-md-between pb-4">
            <div class="col-md-6">
              <div
                class="copyright text-sm font-weight-bold text-center text-md-left"
              >
                &copy; 2023
                <a
                  href="https://fadaeco.com"
                  class="font-weight-bold"
                  target="_blank"
                  >Fadaeco (Pty) Ltd</a
                >. All rights reserved
              </div>
            </div>
            
            <div class="col-md-6">
              <ul
                class="nav justify-content-center justify-content-md-end mt-3 mt-md-0"
              >
                <li class="nav-item">
                  <a
                    class="nav-link font-italic"
                    href="{{route('terms-and-conditions')}}"
                  >
                    Terms &nbsp;and &nbsp;Conditions
                  </a>
                </li>
                <li class="nav-item">
                  {{-- terms-and-conditions --}}
                  <a class="nav-link font-italic" href="{{route('privacy-policy')}}">
                    Privacy Policy
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#"> Cookies </a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('mdb/js/mdb.min.js') }}"></script>

    <script src="{{ asset('mdb/js/popper.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
