<x-guest-layout> 

   <main id="app">
    <section class="pb-5 pt-3">
        <div class="card p-1">
            <div class="row">
                <div class="col-md-5">
                    <div class="">
                        <div class=" p-0   text-center border-bottom pb-2">
                            <img height="300" class=" " :src="productImg(main_img)" class=" " alt="">
                        </div>
                        <div class="d-flex justify-content-around mt-2">
                            <div class="  rounded" v-for="images in product.images ">
                                <img height="100" @click="changeImg(images.url)" :src="productImg(images.url)" class="rounded" :alt="images.title">
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="pl-3 pt-5 ">
                        <p class="h4 font-weight-bold">@{{product.product_name}}</p>
                        {{-- product_name price--}}
                        <p class="h5    " v-if="product.sale_price">
                            <span class="text-muted">Was <del class="">R@{{product.price}}</del></span>
                            <span class="text-danger px-5 mx-5  "> Now R@{{product.sale_price}}</span> 
                        </p>
                        <p class="h5" v-else >R@{{product.price}}</p>
                        <div class=" ">
                            <a  class="btn btn-sm rounded btn-success" @click="add_to_cart(product)">add to cart</a> &nbsp; &nbsp;
                            <a  class="btn btn-sm rounded btn-disabled">add to wishlist</a>
                        </div>

                        <div class="d-flex     pt-3">
                             <div class="d-flex flex-column px-2">
                                <small>Rate this product</small>
                                <div class="  ">
                                    <span v-for="i in 5"><i class="far fa-star px-1" aria-hidden="true"></i></span>
                                </div>
                             </div>
                             <div class="px-2   d-flex flex-column justify-content-center">
                                <a href="" class="">See more reviews</a>
                             </div>
                        </div>
                        <hr>
                        <div class="">
                            <p class="h5">Delivary Details</p>
                            <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum sint,
                                repellat quidem soluta nam incidunt reiciendis laudantium, alias molestias molestiae minima 
                                consequuntur. Doloribus, recusandae ab. Provident dolores pariatur voluptas harum!</p>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                 
                <div class="col-12">
                    <ul class="nav nav-tabs mb-3 pl-5" id="ex-with-icons" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1" role="tab"
                            aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="fas fa-file fa-fw me-2"></i>Product Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2" role="tab"
                            aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="fas fa-info-circle fa-fw me-2"></i>More Info</a>
                        </li> 
                    </ul>
                    <!-- Tabs navs -->
                    
                    <!-- Tabs content -->
                    <div class="tab-content pl-5" id="ex-with-icons-content">
                        <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                            @{{ product.description}}
                        </div>
                        <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                            @{{ product.product_detail}}
                        </div>
                       
                    </div>
                    <!-- Tabs content -->
                </div>

            </div>
        </div>
    </section>
    {{-- <input type="hidden" name="" id=""> --}}
   </main>

    <script>
        const { createApp } = Vue;
   createApp({
     data() {
       return {
         vendor_product_price: '',
         product_price: '',
         product: [],
         margin: '',
         stock_value: 0,
         total_stock_units: 0,
         cart: [],
         cart_productIDs: [],
         cart_qty: 0,
         main_img: '',
        };
     },
     async created(){ 

        let product = @json($product);
            product[0].images = []

        for (let i = 0; i < product.length; i++) {
            product[0].images.push({title: product[i].title , url: product[i].url })            
        }
        this.product = product[0];
        console.log(product[0])
        this.main_img = product[0].images[0]['url']
 
       // if no cart then create new empty cat
         if (!this.checkLocalStorage('cart')) {
             localStorage.setItem('cart', JSON.stringify([]));                
             localStorage.setItem('cart_productIDs', JSON.stringify([]));                
         }
         // always update the UI with data from local storage
         this.cart = JSON.parse(localStorage.getItem('cart'))
         this.cart_productIDs = JSON.parse(localStorage.getItem('cart_productIDs'))

          
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
        //  
        changeImg: function(url){
             this.main_img = url;
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

           console.log(href);
           console.log(item);

          },
         disableAddToCart: function(key){  // not yet done
             // return localStorage.getItem(key) !== null;
         },
         updateCartLocalStorage: function(){
             localStorage.setItem('cart', JSON.stringify(this.cart));                
             localStorage.setItem('cart_productIDs', JSON.stringify(this.cart_productIDs));
             this.cart_qty = JSON.parse(localStorage.getItem('cart')).length
             cart_qty_display(); 
          },
         add_to_cart: function(item){
            console.log(item)
             if (!JSON.parse(localStorage.getItem('cart_productIDs')).includes(item.productID)  ) {
               item.qty = 1
               this.cart.push(item)
               this.cart_productIDs.push(item.productID)
               this.updateCartLocalStorage();
             }  
         },
         // 
     }
  }).mount("#app");

</script>


</x-guest-layout>