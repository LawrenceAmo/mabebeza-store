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
         <script src="{{ asset('mdb/js/vue.js') }}"></script>
         <script src="{{ asset('mdb/js/axios.js') }}"></script>

         {{-- <link sync rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}"> --}}
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">

 
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Libre+Franklin:wght@300&family=Raleway:wght@500;900&display=swap" rel="stylesheet"> 
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
    .searchSuggestions{
      z-index: 100;
      position:absolute;
      top: 60px;
      width: 50%;
    }
    .searchSuggestions li{
      list-style: none;
    }
   </style>
    </head>
    <body>
       
      <header class="nav-bar bg-purple " id="guestApp">
        <div class="   top-nav p-2   d-flex justify-content-between ">
           
            <a class="navbar-brand logo-container d-flex flex-column justify-content-center   " href="/">    
              <img
                alt="logo"
                height="60"
                src="{{ asset('logo.png') }}"
                id=" "
                class="animate fadeInLeft"
              />
            </a>
   
          <div class="search-container w-50   d-xs-none d-flex flex-column justify-content-center" id="">
              <div class="  ">
                <div class="form-group m-0 p-0">
                  <input type="text" v-model="searchProductsText" v-on:keyup="guestSearchProducts($event)"
                    class="form-control m-0 p-2 bg-light  border-bottom" style="height: 35px; background-color:rgb(107, 107, 107);"  placeholder=" Search Any Product Here...">
                  </div>
              </div>
              <div class=" bg-white border rounded searchSuggestions" v-if="searchedProducts.length">
                <ul>
                  <li class="text-dark border-bottom py-2" v-for="item,i in searchedProducts" >
                    <a   class=" row text-purple font-Raleway c-pointer" @click="view_product(item)">
                       <div class="col-3">
                         <img class="" height="50" :src="productImg(item.url)" alt="">
                       </div>  
                       <span class="col-6">@{{ item.product_name }}  </span>
                       <span class="col-3"> &nbsp; &nbsp; R@{{ item.sale_price || item.price }}  </span>
                    </a>
                  </li>                   
                </ul> 
                <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' id="search_product_url"></a>             
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
                    <a href="{{ route('login') }}" class=" text-light nav-link">Log in</a>                       
                    <a href="{{ route('register') }}" class=" text-light nav-link">Register</a>                      
                  @endauth
                @endif       
                | 
                <div class="  d-flex">
                  <a href="{{ route('my_cart') }}" class="text-blue pr-3 pl-3"><i class="fa fa-cart-plus" aria-hidden="true"></i><span id="cart_qty_display">0</span></a> 
                <a href="{{ route('my_cart') }}" class="text-pink d-xs-none pr-5 pl-1"> <i class="fa fa-heart" aria-hidden="true"></i> <span id="cart_qty_display">0</span></a>  
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="border text-dark py-2 pl-2">
          <div class="pl-4 ">
 
            <div class="dropdown">
              <button class="text-light px-md-3 font-weight-bold font-Raleway bg-purple border-0 " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fa fa-bars "></i>  Shop By Category
              </button>
              <div class="dropdown-menu" aria-labelledby="triggerId" >
                <div class="" v-for="category,i in sub_categories">
                  <a href="" class="dropdown-header text-purple" >@{{category.sub_category_name}}</a>  
                  <div class="dropdown-divider"></div>
                </div>
                {{-- <div class="dropdown-divider"></div> --}}
              </div>
            </div>

             <a href="" class="text-light px-3 d-none font-weight-bold font-Raleway"> <i class="fa fa-user    "></i> Cutie of the Year</a>
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
              <div class="d-flex justify-content-around"> 
                <div class="px-2">
                    <img height="20" src="https://cdn.visa.com/v2/assets/images/logos/visa/blue/logo.png" alt="">
                </div>
                <div class="px-2">
                    <img height="20" src="https://www.mastercard.co.za/content/dam/public/mastercardcom/mea/za/logos/mc-logo-52.svg" alt="">
                </div> 
                <div class="px-2">
                    <img height="20" src="https://www.payfast.co.za/eng/images/payment_methods/logo/InstantEFT@2x.png" alt="">
                </div>
                <div class="px-2">
                    <img height="20" src="https://www.payfast.co.za/eng/images/payment_methods/logo/MobiCred@2x.png" alt="">
                </div>
                <div class="px-2">
                    <img height="20" src="https://www.payfast.co.za/eng/images/payment_methods/logo/RCS@2x.png" alt="">
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
    <script src="{{ asset('mdb/js/popper.min.js') }}"></script>

    <script src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('mdb/js/mdb.min.js') }}"></script>
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
                let sub_categories = await axios.get('{{route("get_sub_categories")}}'); 
                this.sub_categories = await sub_categories.data

                let allProductsDB = await axios.get('{{route("get_products")}}');  
                this.allProductsDB = await allProductsDB.data
                console.log(this.sub_categories);
              },
              methods: {
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
                productImg: function(val){
                  return `{{ asset('storage/products/${val}')}}`;
                },
                guestSearchProducts: function(event){
                    const allProductsDB =  this.allProductsDB
                    let search = this.searchProductsText.toLowerCase()
                    
                    this.searchedProducts = [];

                    if (search.length < 1) {    return false       }

                    console.log(allProductsDB)

                    for (let i = 0; i < allProductsDB.length; i++) {
                      let productName = allProductsDB[i].product_name.toLowerCase()
                        if ( productName.includes(search)) {
                          this.searchedProducts.push(allProductsDB[i])
                        } 
                    } 
        
                  },
              },
              
            });
            guestApp.mount('#guestApp')
        
    </script>
    </body>
</html>
