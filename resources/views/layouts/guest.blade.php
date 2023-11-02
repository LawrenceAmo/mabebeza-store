<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fadaeco') }}</title>
 
        {{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
        <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}"> 
        <script src="{{ asset('mdb/js/vue.js') }}"></script>
        <link sync rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
        <script src="{{ asset('mdb/js/axios.js') }}"></script> --}}



        <!-- MDB -->
         <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
         <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Libre+Franklin:wght@300&family=Raleway:wght@500;900&display=swap" rel="stylesheet"> 
         <link rel="stylesheet" href="{{ asset('mdb/css/quick-website.css') }}">
         <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
   <style>
      body {
                font-family: 'Libre Franklin' !important;
            }
      .page-content-conntainer{
        padding-top: 125px !important;
      }
    .top-navbar{
      position: fixed;
      top: 0px;
      width: 100%;
      margin: 0px;
      z-index: 1;
      display: flex;
      background-color: whitesmoke;
    }
    .nav-bar
    {
      position: fixed;
      top: 0px;
      width: 100%;
      z-index: 100;
      background-color: rgb(255, 255, 255);
    }
    .search-container-mobile{
      display: none !important;
      visibility:hidden !important;
    }
    .searchSuggestions{
      z-index: 100;
      position:absolute;
      top: 60px;
      width: 50%;
      max-height: 500px !important;
      overflow-y:scroll !important;
      overflow-x: hidden !important;
    }
    .searchSuggestions li{
      list-style: none;
    }
    .product_name{
    height: 50px !important;
    white-space:pre-wrap !important;  
    overflow: hidden !important; /* Hide any overflowing content */
    text-overflow: ellipsis !important;
   }
   .menu-bar{
    display: flex;
    animation: fadeIn 0.5s ease;
   }
   .menu-bar-toggle{
    display: none;
    animation: fadeIn 0.5s ease;
   }
   .login-mobile{
    display: none !important;
   }
   .tag-new{
     position:absolute !important; 
   }
   .tag-sale{
     position:absolute !important; 
   }
   .location-input{
    z-index: 1000 !important;
   }
   .payment-logos{
    max-height: 20px !important;
   }
   /* //////////////////////// */
   @media (max-width: 575px) { 
    .payment-logos{
    max-height: 10px !important;
   }
    .page-content-conntainer{
        padding-top: 450px !important;
      }
    .search-container-mobile{
      display:flex !important;
      visibility:visible !important;
    } 
    .searchSuggestions{
      z-index: 100;
      position:absolute;
      top: 110px;
      width: 100%;
    }
   }
   .z-index-1000{
    z-index: 1000 !important;
   }
   @media (max-width: 960px) {
    .payment-logos{
    max-height: 15px !important;
   } 
    .page-content-conntainer{
        padding-top: 80px !important;
      }
    .menu-bar, .login-desktop, .cart-desktop{
        display: none !important;
        animation: fadeIn 0.5s ease;
      } 
      .menu-bar-toggle, .login-mobile, .cart-mobile{
        display: flex !important;
      } 
      #menu_bar{
        display: flex;
        flex-direction: column;
        animation: fadeIn 0.9s ease;
       }
      #menu_bar div{
        padding-bottom: 10px;
      }
      /* 0655464609 */
          
   }
   @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
  }
  .product-card-img-container{
   min-height: 180px !important;
  }
  
   </style>
   <script>
    function initMap() {
     
     const getFormInputElement = (component) => document.getElementById(component + '-input');
     const autocompleteInput = getFormInputElement('location');
     const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
       fields: ["address_components", "geometry", "name"],
       types: ["address"],
     });
     autocomplete.addListener('place_changed', function () {
        const place = autocomplete.getPlace();
       if (!place.geometry) {
         // User entered the name of a Place that was not suggested and
         // pressed the Enter key, or the Place Details request failed.
         window.alert('No details available for input: \'' + place.name + '\'');
         return;
       }
        fillInAddress(place);
     });

     function fillInAddress(place) {  // optional parameter
       const addressNameFormat = {
         'street_number': 'short_name',
         'route': 'long_name',
         'locality': 'long_name',
         'administrative_area_level_1': 'short_name',
         'country': 'long_name',
         'postal_code': 'short_name',
       };
       const getAddressComp = function (type) {
         for (const component of place.address_components) {
           if (component.types[0] === type) {
             return component[addressNameFormat[type]];
           }
         }
         return '';
       };
       getFormInputElement('location').value = getAddressComp('street_number') + ' '+ getAddressComp('route');
                //   getAddressComp('street_number')+', '+
                //   getAddressComp('route')+', '+
                //   getAddressComp('locality')+', '+
                //   getAddressComp('administrative_area_level_1')+', '+
                //   getAddressComp('country')+', '+
                //   getAddressComp('postal_code')
                // if locality = to my suburbs and county = gp then enable shop
        set_location(getAddressComp('locality')) 
     } 
   }
  </script>
    </head>
    <body class="bg-white">       
      <header class="nav-bar bg-purple " id="guestApp">
        <div class="   top-nav p-2   d-flex justify-content-between ">           
          <div class=" menu-bar-toggle ">
            <div @click="menu_bar_toggle()" class=" d-flex pt-3 flex-column justify-content-center px-4">
              <i class="fa fa-bars text-white bt-3 fa-2x " aria-hidden="true"></i>
            </div>
          </div>
            <a class="navbar-brand logo-container d-flex flex-column justify-content-center   " href="/">    
              <img
                alt="logo"
                height="60"
                src="{{ asset('logo.png') }}"
                id=" "
                class="animate fadeInLeft"/>
            </a>

          <div class="search-container search-container-desktop  w-50 d-xs-none d-flex flex-column justify-content-center" id="">
              <div class="  ">
                <div class="form-group m-0 p-0">
                  <input type="text" v-model="searchProductsText" v-on:keyup="guestSearchProducts($event)"
                    class="form-control m-0 p-2 bg-light  border-bottom" style="height: 35px; background-color:rgb(107, 107, 107);"  placeholder=" Search Any Product Here...">
                  </div>
              </div>
              <div class=" bg-white border rounded searchSuggestions " height="20" v-if="searchedProducts.length">
                <ul>
                  <li class="text-dark border-bottom py-2" v-for="item,i in searchedProducts" >
                    <div   class=" row text-purple font-Raleway c-pointer product_name" @click="view_product(item)">
                       <div class="col-2">
                         <img class="" height="50" :src="productImg(productUrl(item.url))" alt="">
                       </div>  
                       <span class="col-7">@{{ StringToLowerCase(item.product_name) }}  </span>
                       <span class="col-3"> &nbsp; &nbsp; R@{{ item.sale_price || item.price }}  </span>
                    </div>
                  </li>                   
                </ul> 
                <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' search-href='{{ route('guest_search_product', ['product_name']) }}' id="search_product_url"></a>             
              </div>
              <div class=" bg-white border rounded searchSuggestions" v-if="(!searchedProducts.length && (searchProductsText.length > 1))">
                <ul>
                  <li class="text-dark border-bottom py-2 "  ><i class="">No Items Found</i></li>                   
                </ul>              
              </div>
          </div>   
          <div class="auth-btn-container   d-flex flex-column justify-content-center">  
            <div class="d-flex flex-column justify-content-center">
              <div class=" d-flex     ">
                @if (Route::has('login'))
                  @auth 
                     <a href="{{ url('/accounts') }}" class=" nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i> My Account</a>  
                  @else 
                    <a href="{{ route('login') }}" class=" login-mobile nav-link d-flex flex-column justify-content-center pt-2">
                      <i class="fas fa-user-plus fa-1x text-white "></i>
                    </a>
                    <a href="{{ route('login') }}" class=" login-desktop nav-link d-flex flex-column justify-content-center pt-2">
                      Log in
                    </a>
                    <a href="{{ route('register') }}" class=" login-desktop nav-link d-flex flex-column justify-content-center pt-2">
                      Register
                    </a>                       
                   @endauth
                @endif
                 <div class="d-flex flex-column justify-content-center pt-2">| </div>
                <div class=" d-flex">
                  <div class=" cart-mobile d-none ">
                    <a href="{{ route('my_cart') }}" class=" text-blue pr-3 pl-3 d-flex flex-column justify-content-center pt-2">
                      <span><i class="fa fa-cart-plus fa-1x" aria-hidden="true"></i><span id="cart_qty_display_mobile" class="cart_qty_display">0</span></span>
                    </a>
                  </div>                  
                  <div class="cart-desktop">
                    <a href="{{ route('my_cart') }}" class="  text-blue pr-3 pl-3 d-flex flex-column justify-content-center  pt-2">
                      <span><i class="fa fa-cart-plus  " aria-hidden="true"></i><span id="cart_qty_display_desktop" class="cart_qty_display">0</span></span>
                    </a>
                  </div>
                  <div class=" cart-mobile d-none ">
                    <a href="{{ route('my_wish_list') }}" class=" text-pink pr-3 pl-3 d-flex flex-column justify-content-center pt-2">
                      <span><i class="fa fa-heart fa-1x" aria-hidden="true"></i><span id="wish_list_qty_display_mobile" class="wish_list_qty_display">0</span></span>
                    </a>
                  </div>
                  <div class="cart-desktop">
                    <a href="{{ route('my_wish_list') }}" class="  text-pink pr-3 pl-3 d-flex flex-column justify-content-center  pt-2">
                      <span><i class="fa fa-heart" aria-hidden="true"></i><span id="wish_list_qty_display_desktop" class="wish_list_qty_display">0</span></span>
                    </a>  
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="search-container search-container-mobile bg-white  w-100 d-flex flex-column justify-content-center d-none " id="">
          <div class="  ">
            <div class="form-group m-0 p-0">
              <input type="text"  v-model="searchProductsText" v-on:keyup="guestSearchProducts($event)"
                class="form-control m-0 p-2 bg-white  border rounded-0 rounded-bottom" style="height: 35px; border:#642c94 solid 2px !important;  "  placeholder=" Search Any Product Here...">
              </div>
          </div>
          <div class=" bg-white border rounded searchSuggestions " height="20" v-if="searchedProducts.length">
            <ul>
              <li class="text-dark border-bottom py-2" v-for="item,i in searchedProducts" >
                <div   class=" row text-purple font-Raleway c-pointer product_name" @click="view_product(item)">
                   <div class="col-2">
                     <img class="" height="50" :src="productImg(productUrl(item.url))" alt="">
                   </div>  
                   <span class="col-7">@{{ StringToLowerCase(item.product_name) }}  </span>
                   <span class="col-3"> &nbsp; &nbsp; R@{{ item.sale_price || item.price }}  </span>
                </div>
              </li>                   
            </ul> 
            <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' search-href='{{ route('guest_search_product', ['product_name']) }}'  id="search_product_url"></a>             
          </div>
          <div class=" bg-white border rounded searchSuggestions" v-if="(!searchedProducts.length && (searchProductsText.length > 1))">
            <ul>
              <li class="text-dark border-bottom py-2 "  ><i class="">No Items Found</i></li>                   
            </ul>              
          </div>
      </div>
         <div class=" menu-bar border d-flex justify-content-between text-dark py-2 pl-2 " id="menu_bar">                    
             <div class="pl-sm-4  "> 
              <div class="dropdown">
                <button class="text-light px-md-3 font-weight-bold font-Raleway bg-purple border-0 " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-bars "></i>  Shop By Category
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId" >
                  <div class="" v-for="category in sub_categories" >
                     <a @click="view_sub_category(category)" class="dropdown-header text-purple c-pointer" v-if="!category.sub_category_name.includes('asics')  " >@{{category.sub_category_name}}</a>  
                    <div class="dropdown-divider"></div>
                  </div>
                 </div>
              </div>
               <a href="" class="text-light px-3 d-none font-weight-bold font-Raleway"> <i class="fa fa-user "></i> Cutie of the Year</a>
            </div>
            <div class="">
              <a href="{{ route('gift-registry')}}" class="text-light pr-3 font-Raleway ">Gift Registry</a>
            </div>
            <div class="">
              <a href="{{ route('store-locator')}}" class="text-light pr-3 font-Raleway ">Store Locator</a>
            </div>


            <div class="">
              <div class="dropdown">
                <button class=" text-light pr-3 font-Raleway bg-purple border-0 " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Delivery Details
                    </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                  <a href="{{ route('where_we_deliver')}}" class="text-purple pr-3 font-Raleway dropdown-item">Where We Deliver</a>
                  <div class="dropdown-divider"></div>
                  <a href="{{route('delivery-policy')}}" class="text-purple pr-3 font-Raleway dropdown-item">Delivery Policy</a>
                </div>
              </div> 
            </div>


            <div class="">
              <a href="{{ route('cutie-of-the-year')}}" target="blank" class="text-light pr-3 font-Raleway ">Cutie of the Year</a>
            </div>
            <div class="">
              <a href="{{ route('contact-us')}}" class="text-light pr-3 font-Raleway ">Contact Us</a>
            </div>
            <a href="{{ route('enter_deliver_location') }}" class="text-light pr-3 font-Raleway ">
              Ship To: <span class="font-weight-bold" id="location_display">Not Set</span>
            </a>
         </div>         
      </header>
        <div class="  text-gray font-weight-normal p-0 m-0   antialiased page-content-conntainer"  >
            {{ $slot }}
        </div>
          <footer class="position-relative" id="footer-main pt-0">
      <div class="footer  footer-dark footer-dark">
        <!-- SVG shape -->
        <div
          class="shape-container shape-line shape-position-top shape-orientation-inverse">           
        </div>
        <!-- Footer -->
        <div class="container pt-0 ">
          <div class="row">
            <div class="col-md-4    text-center mb-5 mb-lg-0">
               <a href="/ " class="   d-flex flex-column">
                <img
                  class="w-auto pl-5   "
                  alt="Image placeholder"
                  src="{{ asset('logo-footer.png') }}"
                  id="footer-logo"
                />
               </a>
            </div>
            <div class="col-md-8    d-flex flex-column justify-content-center">
              <div class=" d-flex justify-content-end">
                  <div class="row pl-auto    w-100">
                  <div class="col-4   col-md-4 ml-lg-auto mb-5 mb-lg-0  ">
                  <h6 class="heading mb-3">Account</h6>
                  <ul class="list-unstyled">
                    <li><a href="{{ url('/accounts') }}">My Account</a></li>
                    <li><a href="{{ route('my_cart') }}">My Cart</a></li>
                    <li><a href="{{ route('my_wish_list') }}">My Wish List</a></li>
                  </ul>
                  </div>
                  <div class="col-4 col-md-4 mb-5 mb-lg-0">
                    <h6 class="heading mb-3">About</h6>
                    <ul class="list-unstyled">
                      <li><a href="{{ route('contact-us')}}">Contact Us</a></li>
                      <li><a href="{{ route('store-locator')}}">Store Locator</a></li>
                      <li><a href="{{ route('where_we_deliver')}}"> Where We Deliver</a></li>
                    </ul>
                  </div>
                  <div class="col-4 col-md-4 mb-5 mb-lg-0">
                    <h6 class="heading mb-3">Company</h6>
                    <ul class="list-unstyled">
                     <li><a href="{{ route('contact-us')}}">Help Center</a></li>
                     <li><a href="{{ route('cutie-of-the-year')}}">Cutie of The Year</a></li>
                    </ul>
                  </div>
              </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- Social -->
              <ul class="nav mt-4  ">
                <li class="nav-item">
                  <a class="nav-link" href="https://web.whatsapp.com/" target="_blank">
                    <i class="fab fa-whatsapp"></i> +27 61	589 5114
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" target="_blank" href="https://instagram.com/mabebezababy?igshid=YmMyMTA2M2Y=" >
                    <i class="fab fa-instagram"></i> MabebezaBaby
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.facebook.com/mabebezababy" target="_blank">
                    <i class="fab fa-facebook"></i> MabebezaBaby
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-6  d-flex flex-column justify-content-center">
              <div class="d-flex justify-content-around"> 
                <div class="px-3 py-2 bg-white rounded">
                    <img class="payment-logos" src="https://cdn.visa.com/v2/assets/images/logos/visa/blue/logo.png" alt="">
                </div>
                <div class="px-3 py-2 bg-white rounded">
                    <img class="payment-logos" src="https://www.mastercard.co.za/content/dam/public/mastercardcom/mea/za/logos/mc-logo-52.svg" alt="">
                </div> 
                <div class="px-3 py-2 bg-white rounded">
                    <img class="payment-logos" src="https://www.payfast.co.za/eng/images/payment_methods/logo/InstantEFT@2x.png" alt="">
                </div>
                <div class="px-3 py-2 bg-white rounded">
                    <img class="payment-logos" src="https://www.payfast.co.za/eng/images/payment_methods/logo/MobiCred@2x.png" alt="">
                </div>
                <div class="px-3 py-2 bg-white rounded">
                    <img class="payment-logos" src="https://www.payfast.co.za/eng/images/payment_methods/logo/RCS@2x.png" alt="">
                </div>
            </div>
            </div>
          </div>
          <hr class="divider divider-fade divider-dark my-4" />
          <div class="row align-items-center justify-content-md-between pb-4">
            <div class="col-md-6">
              <div class="copyright text-sm font-weight-bold text-center text-md-left">
                &copy; 2023
                <a href="/"
                  class="font-weight-bold"
                  target="_blank">
                  Mabebeza (Pty) Ltd
                </a>
                  . All rights reserved
              </div>
            </div>

            <div class="col-md-6">
              <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                <li class="nav-item">
                  <a
                    class="nav-link font-italic"
                    href="{{route('terms-and-conditions')}}">
                    Terms &nbsp;and &nbsp;Conditions
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-italic" href="{{route('delivery-policy')}}">
                    Delivery Policy
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-italic" href="{{route('privacy-policy')}}">
                    Privacy Policy 
                  </a>
                </li>
             
              </ul>
            </div>
          </div>
        </div>
      </div>
      <a data-href='{{ route('guest_view_sub_category', [ 'sub_category_name']) }}' id="guest_view_sub_category"></a>

    </footer> 

    <!-- Modal -->
    <div class="modal fade"   id="ship_to_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {{-- <div class="modal-header">
               
          </div> --}}
          <div class="modal-body">
           <div class="d-flex justify-content-between pb-5">
            <p class="h5 text-purple" id="ship_to_modal_msg"></p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           </div>
           <div class=" w-100">
            <a href="{{ route('enter_deliver_location') }}" class=" btn btn-sm rounded btn-purple w-100">enter address where to deliver</a>
          </div>
          </div>
        
        </div>
      </div>
    </div>
 
    {{-- <script src="{{ asset('mdb/js/popper.min.js') }}"></script>
    <script src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.bundle.min.js') }}"></script>
     --}}

     <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js" ></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7uUbl0Ol0kXBam07UPsjThrxL18qoVzA&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

    <script>

      cart_qty_display();

      function wish_list_qty_display() {
          let qty = JSON.parse(localStorage.getItem('wish_list')).length
          document.getElementById('wish_list_qty_display_mobile').innerHTML = qty;
          document.getElementById('wish_list_qty_display_desktop').innerHTML = qty;
      }    

      function set_location(location){
          localStorage.setItem('ship_location', ''+location); 
          set_location_display() 
      }

      function areas(area = null) {
        let locations = [ "Tembisa", "Midrand", "Fourways", "Sunninghill", "Waterfall city", "Farmall", "Diepsloot", "Olievenhoutbosch", "Randjespark", "Noordwyk", "Olifantsfontein", "Clayville" ];
          locations = locations.map(function(string) {  return string.toLowerCase();   }); // convert all areas toLowerCase
          area = area.toLowerCase();

        if (!locations.includes(area)) {
          document.getElementById("ship_to_modal_msg").innerHTML = " Unfortunately we do not deliver to: "+area+" <br>   <a href='{{ route('where_we_deliver')}}' >Please see places we deliver to:</a>";
          $('#ship_to_modal').modal('show');
          localStorage.setItem('cart_productIDs', JSON.stringify([]));
          localStorage.setItem('cart', JSON.stringify([]));
        }  
      }

      // display location to the user
       function set_location_display(){
          let ship_location =  localStorage.getItem('ship_location')
          document.getElementById("location_display").innerHTML = ship_location || 'Not Set';
          if (!ship_location) {
              document.getElementById("ship_to_modal_msg").innerHTML = 'To continue shopping. Please enter address where you want to ship to.';
              $('#ship_to_modal').modal('show');
              return true;
          }
        areas(ship_location)
       }
       let ship_location =  localStorage.getItem('ship_location')
          document.getElementById("location_display").innerHTML = ship_location || 'Not Set';

      //  set_location_display();
      wish_list_qty_display();

      // update the wish list
        function add_to_wish_list(item) {

              let wish_list = JSON.parse(localStorage.getItem('wish_list'));
              let wish_list_productIDs = JSON.parse(localStorage.getItem('wish_list_productIDs'));

              if (!wish_list_productIDs.includes(item.productID)) {

                wish_list.push(item)
                wish_list_productIDs.push(item.productID)
 
              }else{
                 
                wish_list = wish_list.filter(product => product.productID != item.productID);
                wish_list_productIDs = wish_list_productIDs.filter(productID => productID != item.productID);

              } 
              localStorage.setItem('wish_list', JSON.stringify(wish_list));                
              localStorage.setItem('wish_list_productIDs', JSON.stringify(wish_list_productIDs));

              wish_list_qty_display();  
          }

            async function get_sub_categories( ) {
              // get products from api
              function checkLocalStorage(key){
                return localStorage.getItem(key) !== null;
                }
 
                // if (!checkLocalStorage('all_sub_categories')) {
                  let all_sub_categories = await axios.get('{{route("get_sub_categories")}}'); 
                      all_sub_categories = await all_sub_categories.data
                  localStorage.setItem('all_sub_categories', JSON.stringify(all_sub_categories));                
                // }

                let sub_categories = JSON.parse(localStorage.getItem('all_sub_categories'))

               return sub_categories;
            }
             get_sub_categories()

            try {
              createApp ; // Accessing the variable               
             } catch (error) {
              // if (error instanceof ReferenceError) {
                const { createApp } = Vue;
              // }
            }
            const guestApp = createApp({
              data() {
                return {
                  allProductsDB: [],
                  sub_categories: [], 
                  searchedProducts: [],
                  searchProductsText: '',
                }
              },
              async created(){ 
                 this.sub_categories = JSON.parse(localStorage.getItem('all_sub_categories'))  
                 if (!this.checkLocalStorage('all_products')) {
                  let allProductsDB = await axios.get('{{route("get_products")}}');  
                      allProductsDB = await allProductsDB.data                   
                      localStorage.setItem('all_products', JSON.stringify(   allProductsDB));
                      this.allProductsDB = allProductsDB;                                    
                 }

                 setTimeout(async () => {
                    let allProductsDB = await axios.get('{{route("get_products")}}');  
                        allProductsDB = await allProductsDB.data
                         allProductsDB = await this.get_products(allProductsDB) 
                         this.allProductsDB = allProductsDB;                    
                        localStorage.setItem('all_products',   JSON.stringify( allProductsDB));  
                 }, 3000); 
                 this.allProductsDB = JSON.parse(localStorage.getItem('all_products'))                  
              },
              methods: {
                checkLocalStorage: function(key){
                 return localStorage.getItem(key) !== null;
                },
                menu_bar_toggle: function(){
                  let menu_bar = document.getElementById('menu_bar');
                  menu_bar.classList.toggle('menu-bar');
                  console.log("Amo")
                },
                view_product: function(item){
 
                      var link = document.getElementById('search_product_url');
                      var href = link.getAttribute('data-href');
                      let sub_category_name = item.sub_category_name.replace(/ /g, '-')
                      console.log(href)

                      href = href.replace('category', sub_category_name )
                      let product_name = item.product_name.replace(/ /g, '-')+'-'+item.productID
                      href = href.replace('product_name', product_name )
                      location.href = href 
                },
                view_sub_category: function(item){ 
                    var link = document.getElementById('guest_view_sub_category');
                    var href = link.getAttribute('data-href');
                    let sub_category_name = item.sub_category_name.replace(/ /g, '-')                  
                    href = href.replace('sub_category_name', sub_category_name )
                     location.href = href 
                 },
                productImg: function(val){
                  return `{{ asset('storage/products/${val}')}}`;
                }, 
                productUrl: function(val){
                  if (val) {
                    let url = val.split(',') 
                    return url[0];
                  } 
                },
                guestSearchProducts: function(event) {
                      let allProductsDB = this.allProductsDB;
                      let searchWords = this.searchProductsText.toLowerCase().split(/\s+/); // Split by whitespace
                      const searchSuggestionsElements = document.querySelectorAll('.searchSuggestions');

                      this.searchedProducts = [];
                      if (searchWords[0].length < 1) {
                        searchSuggestionsElements.forEach(element => {
                          element.classList.add('d-none');
                        });
                          return false;
                      }
                      for (let i = 0; i < allProductsDB.length; i++) {
                          let productName = allProductsDB[i].product_name.toLowerCase();
                          
                          // Use every() to check if all search words are present in the product name
                          if (searchWords.every(word => productName.includes(word))) {
                              this.searchedProducts.push(allProductsDB[i]);
                          }
                      }
                      if (this.searchedProducts.length < 1) {
                        return false;
                      }
                      if (event.key === "Enter") {
                          // Perform your desired action here
                          console.log("Enter key pressed");
                          var link = document.getElementById('search_product_url');
                          var href = link.getAttribute('search-href');                         
                          searchWords = searchWords.join(" ")
                          searchWords = searchWords.replaceAll(" ", '-')

                          href = href.replace('product_name', searchWords )
 
                          location.href = href
                          console.log(href) 
                      }
                },
                get_products: async function(products){
                
                        let productsDB = []; let productIDs = [];  
                          for (let y = 0; y < products.length; y++) {

                            let productID = products[y].productID; 
                            if (!productIDs.includes(productID)) {
                              if (parseInt(products[y].price) > 0) {
                                productIDs.push(productID);
                                productsDB.push(products[y]);
                              } 
                            }
                           }
                          productsDB = productsDB.filter(value => value !== '');
                          this.allProductsDB = await productsDB                            
                          localStorage.setItem('all_products', JSON.stringify( await productsDB )); 
                           return  productsDB;
                },
                StringToLowerCase: function(string){
                    let words = string.toLowerCase().split(' '); 
                      
                      for (let i = 0; i < words.length; i++) {
                        if (i === 0 || !['and', 'of'].includes(words[i])) {
                          words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                        }
                      }
                      return words.join(' ');
                }
            },             
        });
        guestApp.mount('#guestApp')  
    </script>
    </body>
</html>
