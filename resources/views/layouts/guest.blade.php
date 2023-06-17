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
         <script src="{{ asset('mdb/js/axios.js') }}"></script>

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
    .nav-bar
    {
      position: fixed;
      top: 0px;
      width: 100%;
      z-index: 100;
      background-color: rgb(255, 255, 255)
    }
   </style>
    </head>
    <body>
       
      <header class="nav-bar" id="guest">
        <div class="   top-nav row pb-2  ">
 
          <div class="col-md-4 pl-5">
            <a class="navbar-brand logo  pt-1" href="/">    
              <img
                alt="logo"
                height="60"
                src="{{ asset('logo.png') }}"
                id=" "
                class="animate fadeInLeft"
              />
            </a>
          </div>
  
          <div class="search col-md-4 d-flex flex-column justify-content-center">
              <div class="  ">
                <div class="form-group m-0 p-0">
                  <input type="text"
                    class="form-control m-0 p-0  border-bottom" style="height: 35px;"  name="" id="" aria-describedby="helpId" placeholder=" Search Here...">
                  </div>
              </div>
          </div>
   
          <div class="auth col-md-4 d-flex justify-content-end px-3 float-end">
  
            <div class="d-flex flex-column justify-content-center">
              <div class=" d-flex     ">
                @if (Route::has('login'))
                  @auth 
                     <a href="{{ url('/accounts') }}" class=" nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i> My Account</a>  
                  @else
                    <a href="{{ route('login') }}" class="  nav-link">Log in</a>                       
                    <a href="{{ route('register') }}" class="nav-link">Register</a>                      
                  @endauth
                @endif       
                | 
                <div class="  d-flex">
                  <a href="{{ route('my_cart') }}" class="text-success pr-3 pl-3"><i class="fa fa-cart-plus" aria-hidden="true"></i><span id="cart_qty_display">0</span></a> 
                <a href="{{ route('my_cart') }}" class="text-danger pr-5 pl-1"> <i class="fa fa-heart" aria-hidden="true"></i> <span id="cart_qty_display">0</span></a>  
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="border text-dark py-2 pl-2">
          <div class="pl-4 ">
            <a href="" class="text-dark px-3 font-weight-bold">Shop By Category</a>
            <a href="" class="text-dark px-3 font-weight-bold">Cutie of the Year</a>
          </div>
        </div>
      </header>
        <div class="  text-gray font-weight-normal antialiased" style="margin-top: 115px;">
            {{ $slot }}
        </div>
          <footer class="position-relative" id="footer-main pt-0">
      <div class="footer pt-lg-7 footer-dark footer-dark">
        <!-- SVG shape -->
        <div
          class="shape-container shape-line shape-position-top shape-orientation-inverse"
        >
           
        </div>
        <!-- Footer -->
        <div class="container pt-4 ">
          <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <!-- Theme's logo -->
              <a href="index.html ">
                <img
                  class="w-50"
                  alt="Image placeholder"
                  src="{{ asset('logo.png') }}"
                  id="footer-logo"
                />
              </a>
              <!-- Webpixels' mission -->
              <p class="mt-4 text-sm opacity-8 pr-lg-4">
                We exist to give all babies and their moms the dignity of choice through
                accessible baby products at reasonable prices and offering real services
                that make life easier for mom and baby.
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
                <li><a href="contact.html#departments">Cuty of the year</a></li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- Social -->
              <ul class="nav mt-4  ">
                <li class="nav-item">
                  <a class="nav-link" href="https://web.whatsapp.com/" target="_blank">
                    <i class="fab fa-whatsapp"></i> +27 71 863 2324
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" target="_blank" href="https://www.linkedin.com/in/amomad/" >
                    <i class="fab fa-linkedin-in"></i> MabebezaBaby
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://facebook.com/fadaeco.sa" target="_blank">
                    <i class="fab fa-facebook"></i> MabebezaBaby
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-6  d-flex flex-column justify-content-center">
              <div class="d-flex justify-content-between m-0">
                <div class="px-3">
                  <img src="{{ asset('logo.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('logo.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('logo.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('logo.png') }}" class="" height="25" alt="">
                </div>
                <div class="px-3">
                  <img src="{{ asset('logo.png') }}" class="" height="25" alt="">
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
                  href="https://mabebeza.com"
                  class="font-weight-bold"
                  target="_blank"
                  >Mabebeza (Pty) Ltd</a
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
                  <a class="nav-link font-italic" href="{{route('privacy-policy')}}">
                    Delivary Policy
                  </a>
                </li>
                <li class="nav-item">
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
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
      cart_qty_display();
 
            async function get_sub_categories( ) {
              // get products from api
                let sub_categories = await axios.get('{{route("get_sub_categories")}}');
                sub_categories = await sub_categories.data
                // console.log(sub_categories)

              //  return sub_categories;
            }
            get_sub_categories()
            // this.products = productsDB
       

    </script>
    </body>
</html>
