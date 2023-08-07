<x-guest-layout>

    <main id="app"> 
     <section class="pb-5 pt-3">
      <a class="pl-3">/<a href="/">Home</a>/Categories/@{{category}}</a>
         <div class="card p-3">
              <div class=" py-5" v-if="products.length < 1">
                <p class="h5 text-muted text-center"><span>No products available</span>
                <br>
                  <a href="/" class="btn btn-sm btn-outline-info rounded">Go back home</a></p>
              </div>
                 <div class="row">
                  <div class=" col-6 col-xl-2 col-lg-2 col-md-3 col-sm-4" v-for="product,i in products">
                    <div class="card text-left"   >
                      <div class="tag-sale" v-if="product.sale_price">
                        <span class="bg-pink text-white rounded p-1 font-weight-bold">Sale</span>
                      </div>
                        <img loading="lazy"  @click="view_product(product)" class="c-pointer card-img-top zoom" height="150" :src="productImg(product.url)" alt="">
                        <div class="card-body   px-2 py-0">
                          <a @click="view_product(product)" class="c-pointer card-title py-0 my-0  text-purple text-wrap product_name"  >@{{ StringToLowerCase(product.product_name)}}</a>
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
     <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' id="view_product_url"></a>
    </main>
 
     <script>
            let { createApp } = Vue;
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
          main_img: '',
          category: '',
         };
      },
      async created(){ 
 
         let product = @json($products);
            
         let currentUrl = window.location.href;
         currentUrl = currentUrl.split('/').pop();
         currentUrl = currentUrl.replace(/-/g, " ");
         this.category = currentUrl;

         this.products = product;
         console.log(product)
        //  this.main_img = product[0].images[0]['url']
  
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
              console.log(href)

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
 
 </script>
 </x-guest-layout>