<x-guest-layout>
    <style>
        .add-to-cart-container{
            display: none !important;
        }
        .card:hover .add-to-cart-container{
            display: flex !important;
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
    <div class="carousel-inner" role="listbox" style="height: 350px;">
      <div class="carousel-item active">
        <div class="view">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).webp"
            alt="First slide">
          <div class="mask rgba-black-light"></div>
        </div>
        <div class="carousel-caption">
          <h3 class="h3-responsive">Light mask</h3>
          <p>First text</p>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(6).webp"
            alt="Second slide">
          <div class="mask rgba-black-strong"></div>
        </div>
        <div class="carousel-caption">
          <h3 class="h3-responsive">Strong mask</h3>
          <p>Secondary text</p>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(9).webp"
            alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </div>
        <div class="carousel-caption">
          <h3 class="h3-responsive">Slight mask</h3>
          <p>Third text</p>
        </div>
      </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    {{-- <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> --}}
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->


            {{-- </div> --}}
        </div>
    </section>
    <section>
        <div class=" p-3 px-5  d-flex justify-content-between">
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120" class="  rounded-circle shadow p-1" style="border:3px solid #dd99b0;" src="{{ asset('images/background/images.jpeg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Travel & safety gear</p>
                </a>
             </div>
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120"  class="  rounded-circle shadow p-1" style="border:3px solid #94d2ec;" src="{{ asset('images/background/imagesa.jpeg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Nappies & Wipes</p>
                </a>
             </div>
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120"  class="  rounded-circle shadow p-1" style="border:3px solid  #b0dd99;" src="{{ asset('images/background/images1.jpeg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Food</p>
                </a>
             </div>
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120"  class="  rounded-circle shadow p-1" style="border:3px solid #99B0DD;" src="{{ asset('storage/products/image-ba232811dc285292182ded1ff2b0f8fa4cbym.jpg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Formula</p>
                </a>
             </div>
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120"  class="  rounded-circle shadow p-1" style="border:3px solid #302C94;" src="{{ asset('storage/products/image-ba232811dc285292182ded1ff2b0f8fa4cbym.jpg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Medicine & Hygine</p>
                </a>
             </div>
             <div class="">
                <a href="" class="  rounded-circle shadow" >
                    <img height="120" width="120"  class="  rounded-circle shadow p-1" style="border:3px solid #942C90;" src="{{ asset('storage/products/image-ba232811dc285292182ded1ff2b0f8fa4cbym.jpg')}}" alt="">
                    <p class="h6 font-weight-bold pt-1 text-center">Decor</p>
                </a>
             </div>
        </div>
    </section>
    <hr>
    <section class="">
        <div class=" ">
            <p class=" h3 text-center">Featured Products</p>            
        </div>
        <div class="px-3">
            <div class="row " >

                <div class="col-md-2" v-for="product,i in products">
                    <div class="card text-left"   >
                        <img class="card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                        <div class="card-body   px-2 py-0">
                          <a class="card-title font-weight-light py-0 my-0  text-wrap" style="height: 50px;">@{{ product.product_name}}</a>
                          <p class="card-text d-flex justify-content-between py-0 my-0  ">
                            <span class="text-muted text-danger "> <del>@{{ product.sale_price}}</del> </span>
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
            <p class=" h3 text-center">Best Sellers</p>            
        </div>
        <div class="px-3">
            <div class="row " >

                <div class="col-md-2" v-for="product,i in products">
                    <div class="card text-left"   >
                        <img class="card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                        <div class="card-body   px-2 py-0">
                          <a class="card-title font-weight-light py-0 my-0  text-wrap" style="height: 50px;">@{{ product.product_name}}</a>
                          <p class="card-text d-flex justify-content-between py-0 my-0  ">
                            <span class="text-muted text-danger "> <del>@{{ product.price}}</del> </span>
                            <span class=" font-weight-bold ">@{{ product.price}}</span>
                        </p>
                        {{-- .product.url --}}
                          <p class="card-footer py-0 px-1 m-0 d-flex justify-content-between py-1 add-to-cart-container" >
                            <span class="add-wishlist btn btn-sm rounded btn-danger py-0 px-3">
                                 <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <span class="add-cart btn btn-sm rounded btn-success py-0 px-3">                                
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            </span>
                          </p>
                        </div>
                      </div>
                </div>

            </div>
        </div>

    </section>
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
            cart: []
           };
        },
        async created(){

            if (!this.checkLocalStorage('cart')) {
                localStorage.setItem('cart', JSON.stringify([]));                
            }

            let productsDB = await axios.get('{{route("get_products")}}');  
            productsDB = await productsDB.data
            console.log(productsDB)
            this.products =   productsDB

        },
        methods: {           
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            }, // add_to_cart
            productImg: function(val){
                let url  = `{{ asset('storage/products/${val}')}}`;
                // console.log(url)
                return url;
            },
            checkLocalStorage: function(key){
                return localStorage.getItem(key) !== null;
            },
            add_to_cart: function(item){

                for (let i = 0; i < this.cart.length; i++) {
                     if (this.cart[i].productID == item.productID) {
                        this.cart.push(item)
                    }

                }
                console.log(this.cart)
            }
        }

     }).mount("#app");

</script>
  
</x-guest-layout>  

