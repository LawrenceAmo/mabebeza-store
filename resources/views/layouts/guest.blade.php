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
        {{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}"> --}}
       
        <!-- MDB -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
            rel="stylesheet"
            />
        <link rel="stylesheet" href="{{ asset('mdb/css/quick-website.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('mdb/css/admin.layout.css') }}"> --}}
         {{-- <script src="{{ asset('mdb/js/vue.js') }}"></script> --}}
         <script src="
         https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.min.js
         "></script>
          {{-- <script src="{{ asset('mdb/js/axios.js') }}"></script> --}}
         <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

         {{-- <link sync rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}"> --}}
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">

 
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Libre+Franklin:wght@300&family=Raleway:wght@500;900&display=swap" rel="stylesheet"> 
   <style>
      body {
                font-family: 'Libre Franklin' !important;
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
   
          <div class="search-container w-50 d-xs-none d-flex flex-column justify-content-center" id="">
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
                       <span class="col-7">@{{ item.product_name }}  </span>
                       <span class="col-3"> &nbsp; &nbsp; R@{{ item.sale_price || item.price }}  </span>
                    </div>
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
                <a href="{{ route('my_wish_list') }}" class="text-pink d-xs-none pr-5 pl-1"> <i class="fa fa-heart" aria-hidden="true"></i> <span id="wish_list_qty_display">0</span></a>  
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="border d-flex justify-content-between text-dark py-2 pl-2">
          <div class="pl-4  "> 
            <div class="dropdown">
              <button class="text-light px-md-3 font-weight-bold font-Raleway bg-purple border-0 " type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fa fa-bars "></i>  Shop By Category
              </button>
              <div class="dropdown-menu" aria-labelledby="triggerId" >
                <div class="" v-for="category,i in sub_categories"> 
                  {{-- guest_view_sub_category --}}
                  <a @click="view_sub_category(category)" class="dropdown-header text-purple c-pointer" v-if="category.sub_category_name != Other" >@{{category.sub_category_name}}</a>  
                  <div class="dropdown-divider"></div>
                </div>
                {{-- <div class="dropdown-divider"></div> --}}
              </div>
            </div>

             <a href="" class="text-light px-3 d-none font-weight-bold font-Raleway"> <i class="fa fa-user    "></i> Cutie of the Year</a>
          </div>
          <a href="{{ route('where_we_deliver')}}" class="text-light pr-3 small   font-Raleway ">
            Ship To: <span class="font-weight-bold" id="location_display"></span>
          </a>
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
                <li><a href="{{ url('/accounts') }}">My Account</a></li>
                <li><a href="{{ route('my_cart') }}">My Cart</a></li>
                <li><a href="{{ route('my_wish_list') }}">My Wish List</a></li>
               </ul>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
              <h6 class="heading mb-3">About</h6>
              <ul class="list-unstyled">
                <li><a href="contact.html">About Us</a></li>
                <li><a href="{{ route('where_we_deliver')}}">Contact Us</a></li>
                <li><a href="{{ route('where_we_deliver')}}"> Where We Deliver</a></li>
                {{--  --}}
              </ul>
            </div>
            <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
              <h6 class="heading mb-3">Company</h6>
              <ul class="list-unstyled">
                {{-- <li><a href="contact.html#departments">Information</a></li> --}}
                <li><a href="contact.html#departments">Help Center</a></li>
                 <li><a href="contact.html#departments">Cutie of The Year</a></li>
              </ul>
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
                  href="/"
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
                    Delivery Policy
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
      <a data-href='{{ route('guest_view_sub_category', [ 'sub_category_name']) }}' id="guest_view_sub_category"></a>

    </footer>
  
    <!-- Modal -->
    <div class="modal fade" id="ship_to_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            {{-- <h3 class="modal-title font-weight-bold text-danger">Sorry!!!</h3> --}}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <p class="h5" id="ship_to_modal_msg"></p>
          </div>
        
        </div>
      </div>
    </div>
 
    {{-- <script src="{{ asset('mdb/js/popper.min.js') }}"></script>

    <script src="{{ asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ asset('mdb/js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('mdb/js/mdb.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('mdb/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
    
      cart_qty_display(); 

      function wish_list_qty_display() {
          let qty = JSON.parse(localStorage.getItem('wish_list')).length
          document.getElementById('wish_list_qty_display').innerHTML = qty;
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

       set_location_display();

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
                    // let product_name = item.product_name.replace(/ /g, '-')+'-'+item.productID
                    // href = href.replace('product_name', product_name )

                    location.href = href 
                    console.log(sub_category_name)
                    console.log(href)
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
                guestSearchProducts: function(event){
                    const allProductsDB =  this.allProductsDB
                    let search = this.searchProductsText.toLowerCase()

                    this.searchedProducts = [];
                    if (search.length < 1) {    return false       } 

                    for (let i = 0; i < allProductsDB.length; i++) {
                      let productName = allProductsDB[i].product_name.toLowerCase()
                        if ( productName.includes(search)) {
                          this.searchedProducts.push(allProductsDB[i])
                          console.log(allProductsDB[i])
                        } 
                    }        
                  },
                  // /////////////////
                get_products: async function(products){
                
                        let productsDB = []; let productIDs = [];  
                          for (let y = 0; y < products.length; y++) {
            //  
                            let productID = products[y].productID; 
                            if (!productIDs.includes(productID)) {
                              if (parseInt(products[y].price) > 0) {
                                  
                              // productsDB[ productID ] = [];   // add array of sales for this code
                                productIDs.push(productID);
                                productsDB.push(products[y]);

                              // productsDB[ productID ]['images'] = [];  
                              // productsDB[ productID ]['item'] = [];  
                              // productsDB[ productID ]['item'].push( products[y]); 
                              } 
                            }
                            // productsDB[ productID ]['images'].push( products[y].url);
                          }

                          productsDB = productsDB.filter(value => value !== '');

                          this.allProductsDB = await productsDB   
                          
                          localStorage.setItem('all_products', JSON.stringify( await productsDB )); 

                          // console.log(   productsDB )            
                          // console.log(   productsDB )            

                           return  productsDB;
                },
              },
              
            });
            guestApp.mount('#guestApp')
  
    </script>
    </body>
</html>
