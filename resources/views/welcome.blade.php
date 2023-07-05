<x-guest-layout>
    <style>
  .add-to-cart-container{
      display: none !important;
  }
  .card:hover .add-to-cart-container{
      display: flex !important;
  }
  .carousel {
    max-height: 400px; /* Adjust the value as needed */
    overflow: hidden;
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
    width: 100px;
    height: 100px;
    overflow: scroll !important;
  }
    </style>
<main id="app">
    <section class="  border-bottom pb-2">
        <div class="">
            {{-- <div class="border p-5 bg-black" style="height: 350px;"> --}}
                
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
    <div class="carousel-inner max-vh-30" role="listbox"  >
      <div class="carousel-item active">
        <div class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner1.jpeg')}}"
            alt="First slide">
          <div class="mask rgba-black-light"></div>
        </div>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Light mask</h3>
          <p>First text</p> --}}
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner2.jpeg')}}"
            alt="Second slide">
          <div class="mask rgba-black-strong"></div>
        </div>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Strong mask</h3>
          <p>Secondary text</p> --}}
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img  class="d-block w-100" src="{{ asset('images/background/slides/banner3.jpeg')}}"
            alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </div>
        <div class="carousel-caption">
          {{-- <h3 class="h3-responsive">Slight mask</h3>
          <p>Third text</p> --}}
        </div>
      </div>
    </div>

  </div>
  <!--/.Carousel Wrapper-->
      </div>
        <div class="border bg-purple pb-2">
          <div class="">
            <div class="text-center">
              <span class="font-weight-bold text-light">Where do you want to ship to?</span>
            </div>
            <div class="px-3">
              <input type="text" class="form-control form-control-sm rounded " placeholder="Enter Address" >
            </div>
          </div>
        </div>
    </section>
    <section class=" px-3 d-flex justify-content-between">
               @foreach ($categories as $category)
                <div class="   text-center">
                  <a href="{{ route('guest_view_category', [$category->categoryID, str_replace(' ', '-',$category->category_name)]) }}" class=" text-center shadow" >
                      <img loading="lazy"  class="  main-category-img rounded-circle shadow p-1" style="border:3px solid #94d2ec;" src="{{ asset('images/background/imagesa.jpeg')}}" alt="">
                      <p class="h6 font-weight-bold pt-1  ">{{ $category->category_name}}</p>
                  </a>
                </div>
              @endforeach 
     </section>
    <hr>
    <section class="">
        <div class=" ">
            <p class=" h3 text-center font-Raleway text-purple">Featured Products</p>
        </div>
        <div class="px-3">
            <div class="row " >

                <div class=" col-6 col-xl-2 col-lg-2 col-md-3 col-sm-4" v-for="product,i in products">
                    <div class="card text-left"   >
                        <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                        <div class="card-body   px-2 py-0">
                          <a @click="view_product(product)" class="c-pointer card-title py-0 my-0  text-purple text-wrap" style="height: 50px;">@{{ product.product_name}}</a>
                          <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0 text-purple" v-if="product.sale_price">
                            <span class="text-muted   " >
                               <del class="text-muted">@{{ product.price}}</del> 
                            </span>
                            <span class=" font-weight-bold ">@{{ product.sale_price}}</span>
                          </p>
                          <p @click="view_product(product)" class="c-pointer text-purple card-text d-flex justify-content-between py-0 my-0" v-else>
                            <span class=" "> </span>
                            <span class=" font-weight-bold ">@{{ product.price}}</span>
                          </p>

                          <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                            <span class="add-wishlist btn btn-sm rounded btn-pink py-0 px-3">
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
    <hr>
    <section class="">
        <div class=" ">
            <p class=" h3 text-center font-Raleway text-purple">Best Sellers</p>            
        </div>
        <div class="px-3">
            <div class="row " >

              <div class="col-md-2" v-for="product,i in products">
                <div class="card text-left"   >
                  <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                  <div class="card-body   px-2 py-0">
                    <a @click="view_product(product)" class="c-pointer card-title font-weight-light py-0 my-0  text-wrap" style="height: 50px;">@{{ product.product_name}}</a>
                    <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0" v-if="product.sale_price">
                      <span class="text-muted   " >
                         <del class="text-muted">@{{ product.price}}</del> 
                      </span>
                      <span class=" font-weight-bold ">@{{ product.sale_price}}</span>
                    </p>
                    <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0" v-else>
                      <span class=" "> </span>
                      <span class=" font-weight-bold ">@{{ product.price}}</span>
                    </p>

                    <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                      <span class="add-wishlist btn btn-sm rounded btn-danger py-0 px-3">
                           <i class="fa fa-heart" aria-hidden="true"></i>
                      </span>
                      <span class="add-cart btn btn-sm rounded btn-success py-0 px-3" @click="add_to_cart(product)">                                
                          <i class="fa fa-cart-plus" aria-hidden="true"></i>
                      </span>
                    </p>
                  </div>
               </div>
            </div>

            </div>
        </div>

    </section>
    <hr>
    <section class="">
      <div class=" ">
          <p class=" h3 text-center font-Raleway text-purple"> Sale</p>            
      </div>
      <div class="px-3">
          <div class="row " >

            <div class="col-md-2" v-for="product,i in products">
              <div class="card text-left"   >
                <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                <div class="card-body   px-2 py-0">
                  <a @click="view_product(product)" class="c-pointer card-title font-weight-light py-0 my-0  text-wrap" style="height: 50px;">@{{ product.product_name}}</a>
                  <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0" v-if="product.sale_price">
                    <span class="text-muted   " >
                       <del class="text-muted">@{{ product.price}}</del> 
                    </span>
                    <span class=" font-weight-bold ">@{{ product.sale_price}}</span>
                  </p>
                  <p @click="view_product(product)" class="c-pointer card-text d-flex justify-content-between py-0 my-0" v-else>
                    <span class=" "> </span>
                    <span class=" font-weight-bold ">@{{ product.price}}</span>
                  </p>

                  <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                    <span class="add-wishlist btn btn-sm rounded btn-danger py-0 px-3">
                         <i class="fa fa-heart" aria-hidden="true"></i>
                    </span>
                    <span class="add-cart btn btn-sm rounded btn-success py-0 px-3" @click="add_to_cart(product)">                                
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    </span>
                  </p>
                </div> 
             </div> 
          </div>
          </div>
      </div>
  </section>   
    <hr>
    <section>
      <div class=" ">
        <p class=" h3 text-center font-Raleway text-purple">Our Partners</p>            
    </div>
      <div class=" p-3 px-5  d-flex justify-content-between">
            <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
                </a>
            </div>
              <div class="">
                <a href="" class="  rounded-circle shadow" >
                  <div class="text-center"> 
                    <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">            </div>
                  <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
                </a>
            </div>
            <div class="">
              <a href="" class="  rounded-circle shadow" >
                  <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">
                  <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
              </a>
          </div>            
          <div class="">
            <a href="" class="  rounded-circle shadow" >
                <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">
                <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
            </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
                <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">
                <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
            </a>
          </div>
          <div class="">
            <a href="" class="  rounded-circle shadow" >
                <img loading="lazy" height="80"    class="  bg-dark p-1 rounded " src="https://images.ctfassets.net/9wtva4vhlgxb/7jkYyii10bNnsldUFDkTzC/2b714b229ea20ab5bd68f5da8fc5a0ca/White__1_.svg" alt="">
                <p class="h6 font-weight-bold pt-1 text-center">Pampers</p>
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

            // always update the UI with data from local storage
            this.cart = JSON.parse(localStorage.getItem('cart'))
            this.cart_productIDs = JSON.parse(localStorage.getItem('cart_productIDs'))

            // get products from api
            let productsDB = await axios.get('{{route("get_products")}}');  
                productsDB = await productsDB.data
             this.products = productsDB

        },
        methods: {
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            },  
            productImg: function(val){
              return `{{ asset('storage/products/${val}')}}`;
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
            },
         }
     }).mount("#app");

</script>

  
</x-guest-layout>  
 