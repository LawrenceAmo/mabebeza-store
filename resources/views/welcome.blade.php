<x-guest-layout>
    <style>
 
  .carousel {
    max-height: 350px !important;  
     overflow: hidden;
  }
  .carousel-indicators li {
        border-radius: 50%;
        width: 20px !important;
        height: 20px !important;
        margin: 0 4px;
        background-color: #dd99b0;
    }
  @media (max-width: 575px) {
    .carousel-indicators li {
         width: 10px !important;
        height: 10px !important; 
    }
    .carousel {
    padding-top: 32px !important;  
   }
  }
  .carousel .carousel-inner {
    max-height: 100%;
  }

  .carousel .carousel-item {
    height: 100%;
  }
  .carousel .carousel-item img {
    max-height: 100%;
    width: auto;
  }
  .main-category-img{
    width: 150px;
    height: 150px;
    overflow: scroll !important;
  }
 .main-categories{
    width: 100% !important;
    overflow: auto !important;
    white-space: nowrap !important; /* Prevent line breaks */
  }
  .hr{
    background-color: rgb(227, 215, 230) !important;
    padding: 0px !important;
    margin: 0px !important;
    padding-top: 20px !important;
     padding-bottom: 20px !important;
  }
  

    .carousel-indicators .active {
        background-color: #642c94;
    }
    </style>
    
<main id="app">
    <section class="  border-bottom pb-2 ">
        <div class="">
                <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" >
    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-2" data-slide-to="1"></li>
      <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol> 
    <!--/.Indicators-->
    <!-- Slides -->
    <div class="carousel-inner  " role="listbox"  >
      <a href="#sale" class="carousel-item active">
        <div class="view">
          <img  class="d-block w-100  " src="{{ asset('images/background/slides/banner1.jpg')}}"
            alt="First slide">
          <div class="mask rgba-black-light"></div>
        </div>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Light mask</h3>
          <p>First text</p> --}}
        </div>
      </a>
      {{-- <div class="carousel-item d-none">
         <div class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner2.jpg')}}"
            alt="Second slide">
          <div class="mask rgba-black-strong"></div>
        </div>
        <div class="carousel-caption">
          
        </div>
      </div> --}}
      <div class="carousel-item">
        <!--Mask color-->
        <a href="{{ route('store-locator')}}" class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner3.jpg')}}"
            alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </a>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Slight mask</h3>
          <p>Third text</p> --}}
        </div>
      </div>
      <a href="#sale" class="carousel-item">
        <!--Mask color-->
        <a  class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner4.jpg')}}"
            alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </a>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Slight mask</h3> 
          <p>Third text</p> --}}
        </div>
      </a>
    </div>

        <!-- Controls -->
      {{-- <button class="carousel-control-prev" type="button" href="#carousel-example-2" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" href="#carousel-example-2" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button> --}}

  </div>
  <!--/.Carousel Wrapper-->
      </div>
        <div class="  bg-purple pb-2">
          <div class="">
            <div class="text-center">
              <span class="font-weight-bold text-light">Where do you want to ship to?</span>
            </div>
            <div class="px-3">
              <input type="text" class="form-control form-control-sm rounded location-input location-inactive" placeholder="Enter Address"  id="location-input" >
            </div>
          </div>
        </div>
    </section>
    <section class=" px-3 d-flex justify-content-between main-categories" style="">
               @foreach ($categories as $category)
                @if ($category->category_name != 'Other')
                <div class="   text-center">
                  <a href="{{ route('guest_view_category', [$category->categoryID, str_replace(' ', '-',$category->category_name)]) }}" class=" text-center shadow" >
                      <img loading="lazy"  class="  main-category-img rounded-circle shadow p-1" style="border:3px solid #94d2ec;" src="{{ asset('storage/images/background/'.$category->category_short_descript)}}" alt="">
                      <p class="h6 font-weight-bold pt-1  ">{{ $category->category_name}}</p>
                  </a>
                </div>
                @endif
              @endforeach 
     </section>
    <hr class="hr">
    <section class="">
        <div class="">
            <p class=" h3 text-center font-Raleway text-purple">Featured Products</p>
        </div>
        <div class="px-3">
            <div class="row " >

                <div class=" col-6 col-xl-2 col-lg-2 col-md-3 col-sm-4" v-for="product,i in featured_products" >
                    <div class="card text-left"  >
                      <div class="tag-sale" v-if="product.sale_price">
                        <span class="bg-pink text-white rounded p-1 font-weight-bold">Sale</span>
                      </div>
                        <img loading="lazy"  @click="view_product(product)" class="c-pointer rounded zoom img-fluid"   :src="productImg(product.url)" alt="">
                        <div class="card-body   px-2 py-0">
                          <p @click="view_product(product)" class="c-pointer card-title py-0 my-0  text-purple product_name"  >@{{ StringToLowerCase(product.product_name) }}</p>

                          <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0 text-purple" v-if="product.sale_price">
                            <span class="text-muted   " >
                              <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                               <del class="text-muted" v-else>R@{{ product.price}}</del> 
                            </span>
                            <span class=" font-weight-bold "  >R@{{ product.sale_price}}</span>
                          </p> 

                          <p @click="view_product(product)" class="c-pointer text-purple card-text d-flex justify-content-between py-0 my-0" v-else>
                            <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                            <span v-else></span>
                            <b class=" font-weight-bold ">R@{{ product.price}}</b>
                          </p>

                          <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                            <span class="add-wishlist btn btn-sm rounded btn-pink py-0 px-3"   @click="add_to_wish_list(product)">
                                 <i class="fa fa-heart" aria-hidden="true"></i>
                            </span> 
                            <span class="add-cart btn btn-sm rounded btn-purple py-0 px-3" @click="add_to_cart(product)">                                
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            </span>
                          </p>
                        </div>
                     </div>
                </div>

            </div>
        </div>

    </section>
    <hr class="hr">
    <section class="">
        <div class=" ">
            <p class=" h3 text-center font-Raleway text-purple">New Items</p>            
        </div>
        <div class="px-3">
            <div class="row " >

              <div class=" col-6 col-xl-2 col-lg-2 col-md-3 col-sm-4" v-for="product,i in new_products">
                <div class="card text-left" >
                  <div class="tag-new">
                    <span class="bg-purple rounded p-1 font-weight-bold">New</span>
                  </div> 
                  <div class="product-card-img-container">
                    <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom"  :src="productImg( product.url )" alt="">
                  </div>
                  <div class="card-body   px-2 py-0">
                      <p @click="view_product(product)" class="c-pointer card-title py-0 my-0  text-purple product_name"  >@{{ StringToLowerCase(product.product_name)}}</p>
                      <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0 text-purple" v-if="product.sale_price">
                        <span class="text-muted   " >
                          <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                           <del class="text-muted" v-else>R@{{ product.price}}</del> 
                        </span>

                        <span class=" font-weight-bold "  >R@{{ product.sale_price}}</span>
                      </p> 

                      <p @click="view_product(product)" class="c-pointer text-purple card-text d-flex justify-content-between py-0 my-0" v-else>
                        <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                        <span v-else></span>
                        <b class=" font-weight-bold ">R@{{ product.price}}</b>
                      </p>

                      <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                        <span class="add-wishlist btn btn-sm rounded btn-pink py-0 px-3"   @click="add_to_wish_list(product)">
                             <i class="fa fa-heart" aria-hidden="true"></i>
                        </span> 
                        <span class="add-cart btn btn-sm rounded btn-purple py-0 px-3" @click="add_to_cart(product)">                                
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </span>
                      </p>
                    </div>
                 </div>
            </div>

            </div>
        </div>
 
    </section>
    <hr class="hr"  id="sale">
    <section class="">
      <div class=" ">
          <p class=" h3 text-center font-Raleway text-purple" > Sale</p>            
      </div>
      <div class="px-3">
          <div class="row " >

            <div class=" col-6 col-xl-2 col-lg-2 col-md-3 col-sm-4" v-for="product,i in sale_products">
              <div class="card text-left" >
                  <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom"  :src="productImg(product.url)" alt="">
                  <div class="card-body   px-2 py-0">
                    <p @click="view_product(product)" class="c-pointer card-title py-0 my-0  text-purple product_name"  >@{{ StringToLowerCase(product.product_name) }}</p>
                    <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0 text-purple" v-if="product.sale_price">
                      <span class="text-muted   " >
                        <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                         <del class="text-muted" v-else>R@{{ product.price}}</del> 
                      </span>

                      <span class=" font-weight-bold "  >R@{{ product.sale_price}}</span>
                    </p> 

                    <p @click="view_product(product)" class="c-pointer text-purple card-text d-flex justify-content-between py-0 my-0" v-else>
                      <span class=" small text-pink " v-if="product.quantity <= 1" >Out Of Stock</span>
                      <span v-else></span>
                      <b class=" font-weight-bold ">R@{{ product.price}}</b>
                    </p>

                    <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                      <span class="add-wishlist btn btn-sm rounded btn-pink py-0 px-3"   @click="add_to_wish_list(product)">
                           <i class="fa fa-heart" aria-hidden="true"></i>
                      </span> 
                      <span class="add-cart btn btn-sm rounded btn-purple py-0 px-3" @click="add_to_cart(product)">                                
                          <i class="fa fa-cart-plus" aria-hidden="true"></i>
                      </span>
                    </p>
                  </div>
               </div>
          </div>
          </div>
      </div>
  </section>   
    <hr class="hr">
    <section>
      <div class=" ">
        <p class=" h3 text-center font-Raleway text-purple">Our Partners</p>            
    </div>
      <div class=" p-3 px-5  d-flex justify-content-between main-categories">
            <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img loading="lazy" height="100" class=" p-1 rounded " src="{{ asset('/images/brands/Picture1.png') }}" alt="">
                    {{-- <p class="h6 font-weight-bold pt-1 text-center">Pampers</p> --}}
                </a>
            </div>
              <div class="">
                <a href="" class="  rounded-circle shadow" >
                  <div class="text-center"> 
                    <img loading="lazy" height="80" class=" p-1 rounded " src="{{ asset('images/brands/Picture2.png') }}" alt="">
                  </div>
                 </a>
            </div>
            <div class="">
              <a href="" class="  rounded-circle shadow" >
              <img loading="lazy" height="80" class=" p-1 rounded " src="{{ asset('images/brands/Picture3.png') }}" alt="">
              </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
            <img loading="lazy" height="80" class=" p-1 rounded " src="{{ asset('images/brands/Picture4.png') }}" alt="">
            </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
            <img loading="lazy" height="80"    class="    p-1 rounded " src="{{ asset('images/brands/Picture5.png') }}" alt="">
            </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
            <img loading="lazy" height="80"    class="    p-1 rounded " src="{{ asset('images/brands/Picture6.png') }}" alt="">
            </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
            <img loading="lazy" height="80"    class="    p-1 rounded " src="{{ asset('images/brands/Picture7.png') }}" alt="">
            </a>
          </div>
      </div>
  </section>

 <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' id="view_product_url"></a>
 </main>

<script>
  const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            product_price: '',
            products: [],
            featured_products: [],
            new_products: [],
            sale_products: [],
            margin: '',
            stock_value: 0,
            total_stock_units: 0,
            cart: [],
            cart_productIDs: [],
            cart_qty: 0,
           };
        },
        async created(){  

          // if no cart then create new empty cat
            if (!this.checkLocalStorage('cart')) {
                localStorage.setItem('cart', JSON.stringify([]));                
                localStorage.setItem('cart_productIDs', JSON.stringify([]));                
            }

            if (!this.checkLocalStorage('wish_list')) {
                localStorage.setItem('wish_list', JSON.stringify([]));                
                localStorage.setItem('wish_list_productIDs', JSON.stringify([]));                
            }

            // always update the UI with data from local storage
            this.cart = JSON.parse(localStorage.getItem('cart'))
            this.cart_productIDs = JSON.parse(localStorage.getItem('cart_productIDs'))

            // get products from api
            let products = JSON.parse(localStorage.getItem('all_products'))
            setTimeout(() => {
              let products = JSON.parse(localStorage.getItem('all_products'))
              this.sort_products(products);
            }, 5000);

            // console.log(this.products)
            this.sort_products(products);

            console.log(this.featured_products) 
        },
        methods: {
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            },
            sort_products: function(products){
              this.featured_products =[];
              this.new_products =[];
              this.sale_products =[];
                for (let i = 0; i < products.length; i++) {
                  if (products[i].type == 'featured') {
                    this.featured_products.push(products[i])
                  }
                  if (products[i].type == 'new') {
                    this.new_products.push(products[i])
                  }
                  if (products[i].type == 'sale') {
                    this.sale_products.push(products[i])
                  }              
              }
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
            checkLocalStorage: function(key){
                return localStorage.getItem(key) !== null;
            },
            view_product: function(item){
                var link = document.getElementById('view_product_url');
                var href = link.getAttribute('data-href');
                let sub_category_name = item.sub_category_name.replace(/ /g, '-')
                href = href.replace('category', sub_category_name )
                let product_name = item.product_name.replace(/ /g, '-')+'-'+item.productID
                href = href.replace('product_name', product_name )   
                location.href = href  
             }, 
            updateCartLocalStorage: function(){
                localStorage.setItem('cart', JSON.stringify(this.cart));                
                localStorage.setItem('cart_productIDs', JSON.stringify(this.cart_productIDs));
                this.cart_qty = JSON.parse(localStorage.getItem('cart')).length
                cart_qty_display(); 
             },
            add_to_cart: function(item){
                if (!JSON.parse(localStorage.getItem('cart_productIDs')).includes(item.productID)  ) {
                  item.qty = 1;
                  this.cart.push(item)
                  this.cart_productIDs.push(item.productID)
                  this.updateCartLocalStorage();
                }
                check_delivery_area()
                // add_to_cart(item)
                // console.log(item)
            },
            add_to_wish_list: function(item){
              add_to_wish_list(item) 
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
         }
     }).mount("#app");
 
</script>
 
</x-guest-layout>  
 