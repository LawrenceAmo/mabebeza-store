<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fadaeco') }}</title> 
        <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
        <link rel="stylesheet" href="{{ asset('mdb/css/quick-website.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('mdb/css/admin.layout.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
        <script src="{{ asset('mdb/js/vue.js') }}"></script>
        <script src="{{ asset('mdb/js/axios.js') }}"></script>

        <link sync rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
 
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
        <div class="   top-nav row pb-2 border-bottom ">
 
          <div class="col-6   pl-md-5  ">
            <a class="navbar-brand logo  pt-1" href="/accounts">    
              <img
                alt="logo"
                height="60"
                src="{{ asset('logo.png') }}"
                id=" "
                class="animate fadeInLeft"
              />
            </a>
          </div>
   
          <div class="auth col-6 col-sm-6   d-flex justify-content-end px-md-3  ">
  
            <div class="d-flex flex-column justify-content-center">
              <div class=" d-flex     ">
                @if (Route::has('login'))
                  @auth 
                    <div class=" d-flex pr-3">
                        <a href="/" class="text-success"><i class="fas fa-shopping-cart    "></i></a>
                        <a href="{{ route('guest_customer_profile') }}" class=" nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i> Hi {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>  
 
                            <form action="{{ route('logout') }}" method="POST"
                                class=" "
                                >
                                @csrf
                                <label for="logout" class="c-pointer  text-danger"><i class="fas fa-door-open"></i> </label>
                                <input type="submit" name="" id="logout" class="d-none" >
                            </form>
                     </div>
                  @else
                    <a href="{{ route('login') }}" class="  nav-link">Log in</a>                       
                    <a href="{{ route('register') }}" class="nav-link">Register</a>                      
                  @endauth
                @endif       
                {{-- | 
                <div class="  d-flex">
                  <a href="{{ route('my_cart') }}" class="text-success pr-3 pl-3"><i class="fa fa-cart-plus" aria-hidden="true"></i><span id="cart_qty_display">0</span></a> 
                <a href="{{ route('my_cart') }}" class="text-danger pr-5 pl-1"> <i class="fa fa-heart" aria-hidden="true"></i> <span id="cart_qty_display">0</span></a>  
                </div> --}}
              </div>
            </div>
          </div>
        </div>
       
      </header>
        <div class="  text-gray font-weight-normal antialiased" style="margin-top: 115px;">
            {{ $slot }}
        </div>
          <footer class="position-relative" id="footer-main pt-0">
       
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
