<x-guest-layout> 
    <style>
.image-container {
    /* width: 300px; */
    height: 300px;
    /* overflow: hidden; */
    /* position: relative; */
  }

  .magnifier {
    width: 100px;
    height: 100px;
    border: 2px solid #ccc;
    position: absolute;
    pointer-events: none;
    display: none;
    background-repeat: no-repeat;
    background-size: 400% 400%;
    transform: translate(100%, -70%); /* Center the magnifier */
  }

  .image-container img {
    height: 100%;
    transition: transform 0.2s ease;
    transform-origin: 0 0;
  }
    </style>
   <main id="app">
    <section class="pb-5 pt-3">
        <a class="pl-3"> / <a href="/">Home</a> / <a href="/" class="">@{{product.sub_category_name}}</a> / @{{ StringToLowerCase(product.product_name)}}</a> 
        <div class="card p-1">
            <div class="row">
                <div class="col-md-5">
                    <div class="">
                        <div class=" p-0 image-container  text-center border-bottom pb-2">
                            <div class="magnifier"></div>
                            <img   class=" " :src="productImg(main_img)" class="product-image img" alt="">
                        </div>
                        <div class="d-flex justify-content-around mt-2">
                            <div class="  rounded" v-for="images in product.images ">
                                <img height="100" @click="changeImg(images.url)" :src="productImg(images.url)" class="rounded" :alt="images.title">
                            </div>                            
                        </div> 
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="pl-3 pt-3 ">
                        <b class=" small text-white bg-pink rounded p-1   " v-if="product.quantity <= 1" >Out Of Stock</b>
                        <p class="h4 font-weight-bold font-Raleway">@{{ StringToLowerCase(product.product_name) }}</p>
                        {{-- product_name price--}}
                        <p class="h5   font-Raleway " v-if="product.sale_price">
                            <span class="text-muted">Was <del class="">R@{{product.price}}</del></span>
                            <span class="text-danger px-5 mx-5  "> Now R@{{product.sale_price}}</span> 
                        </p>
                        <p class="h5 font-Raleway" v-else >R@{{product.price}}</p>
                        <div class=" row   pr-1 ">
                            <div class="col-md-6 d-flex flex-column justify-content-center pt-4 m-auto  ">
                                <div class="p-2"></div>
                                {{-- inCart --}}
                                <a v-if="!inCart" class="btn btn-sm rounded text-white btn-purple" @click="add_to_cart(product)" >add to cart</a> &nbsp; &nbsp;
                                <a v-else class="btn btn-sm rounded btn-purple " @disabled(true) @click="add_to_cart(product)" >Add</a> &nbsp; &nbsp;
                            </div>
                            <div class="col-md-5 d-flex flex-column justify-content-center pt-4 m-auto  ">
                                <div class="p-2"></div>
                                {{-- inCart --}}
                                <a  class="btn btn-sm rounded text-white btn-pink"  @click="add_to_wish_list(product)" >add to wish list</a> &nbsp; &nbsp;
                             </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group px-5">
                                <label class="text-center font-weight-bold">Qty</label>
                                {{-- v-model="product.qty" --}}
                               <select class="form-control form-control-sm" v-model="product.qty"  @change="addCartQty(product)">   
                                <option v-for="x in product.quantity" :value="x" >@{{x}}</option>                                           
                              </select>
                            </div>
                        </div>

                        <div class="d-flex pt-3">
                             <div class="d-flex flex-column px-2">
                                <small>Rate this product</small> 
                                <div class="  ">
                                    <span v-for="i in 5"><i class="far fa-star px-1" aria-hidden="true"></i></span>
                                </div>
                             </div>
                             <div class="px-2   d-flex flex-column justify-content-center">
                                <a href="" class="font-libre">See more reviews</a>
                             </div>
                        </div>
                        <hr>
                           
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-12">
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs mb-3 pl-5" id="ex-with-icons" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-purple active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#description" role="tab"
                                aria-controls="description" aria-selected="true"><i class="fas fa-file fa-fw me-2"></i>Product Description</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-purple" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#product_details" role="tab"
                                aria-controls="product_details" aria-selected="false"><i class="fas fa-info-circle fa-fw me-2"></i>More Info</a>
                        </li>
                    </ul>
                
                    <!-- Tabs content -->
                    <div class="tab-content pl-5" id="ex-with-icons">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                             <span  v-html="product.description"> </span>
                        </div>
                        <div class="tab-pane fade" id="product_details" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                           Barcode &nbsp; @{{ product.sku }} <br>
                           <span  v-html="product.product_detail"> </span>
                         </div>
                    </div>
                    <!-- Tabs content -->
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
         product: [],
         margin: '',
         stock_value: 0,
         total_stock_units: 0,
         cart: [],
         cart_productIDs: [],
         cart_qty: 0,
         main_img: '',
         product_qty: 0,
         inCart: false,
        };
     },
     async created(){ 

        let product = @json($product);
            product[0].images = []

        for (let i = 0; i < product.length; i++) {
            product[0].images.push({title: product[i].title , url: product[i].url })            
        }
        this.product = product[0];
        this.main_img = product[0].images[0]['url']
 
       // if no cart then create new empty cat
         if (!this.checkLocalStorage('cart')) {
             localStorage.setItem('cart', JSON.stringify([]));                
             localStorage.setItem('cart_productIDs', JSON.stringify([]));                
         }
         // always update the UI with data from local storage
         this.cart = JSON.parse(localStorage.getItem('cart'))
         this.cart_productIDs = JSON.parse(localStorage.getItem('cart_productIDs'))
         
         if (this.cart_productIDs.includes(product[0].productID)) {
            for (let i = 0; i < this.cart.length; i++) {
                    if (this.cart[i].productID === product[0].productID) {
                        this.product.qty = this.cart[i].qty
                     }
            }
            this.inCart = true;
         }else{
            this.product.qty = 1;
         }
console.log(this.product)
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
         addCartQty: function(item){ 

              console.log(item)
            //  check if this product is in cart, if yes then update it's qty
             if (this.cart_productIDs.includes(item.productID)) {
                for (let i = 0; i < this.cart.length; i++) {
                    if (this.cart[i].productID === item.productID) {
                        this.cart[i].qty = item.qty
                     }
                 }
             }
              else{
                 this.add_to_cart(item, item.qty );
             }           
             this.updateCartLocalStorage();
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
         updateCartLocalStorage: function(){
             localStorage.setItem('cart', JSON.stringify(this.cart));                
             localStorage.setItem('cart_productIDs', JSON.stringify(this.cart_productIDs));
             this.cart_qty = JSON.parse(localStorage.getItem('cart')).length
             cart_qty_display(); 
          },
         add_to_cart: function(item, qty = 1){
             if (!JSON.parse(localStorage.getItem('cart_productIDs')).includes(item.productID)  ) {
               item.qty = qty
               this.cart.push(item)
               this.cart_productIDs.push(item.productID)
             }else{
                for (let i = 0; i <  this.cart.length; i++) {
                    if ( this.cart[i].productID === item.productID) {
                        this.cart[i].qty++;
                        this.product.qty = this.cart[i].qty
                        this.inCart = true;
                        break;
                    }                    
                }
             } 
             this.updateCartLocalStorage();
             check_delivery_area() 
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
         // 
     }
  }).mount("#app");

  
  document.addEventListener('DOMContentLoaded', () => {
    const imageContainer = document.querySelector('.image-container');
    const magnifier = document.querySelector('.magnifier');
    const image = imageContainer.querySelector('img');

    const magnifierWidth = magnifier.offsetWidth;
    const magnifierHeight = magnifier.offsetHeight;

    image.addEventListener('mousemove', (e) => {
      const x = e.offsetX;
      const y = e.offsetY;

      magnifier.style.backgroundImage = `url("${image.src}")`;
      magnifier.style.backgroundPosition = `-${x - magnifierWidth / -100}px -${y - magnifierHeight / 10}px`;

      magnifier.style.left = x + 'px';
      magnifier.style.top = y + 'px';

      magnifier.style.display = 'block';
    });

    image.addEventListener('mouseleave', () => {
      magnifier.style.display = 'none';
    });
  });
  


</script>


</x-guest-layout>