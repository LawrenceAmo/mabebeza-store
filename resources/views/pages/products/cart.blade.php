<x-guest-layout> 

    <main id="app">
     <section class="pb-5 pt-3">
      <a class="pl-3">/<a href="/">Home</a>/Cart</a>
         <div class="  p-3">
             
                 <div class=" row">
                    <div class="col-md-8">
                        <div class="w-100 m-0 pt-3  w-100 rounded border-bottom shadow py-5" v-if="cart.length < 1">
                            <p class="h5 text-muted text-center"><span>Your cart is empty...</span><br>
                              <a href="/" class="btn btn-sm btn-outline-info rounded">Go Shopping</a></p>
                          </div>
                        <div class="w-100 border-bottom" v-for="product,i in cart">                     
                            <div  class="shadow c-pointer m-0  p-0 row  w-100 rounded">
                                <div @click="view_product(product)" class="col-2">
                                    <img height="80" :src="productImg(product.url)" alt="">
                                </div>
                                <div @click="view_product(product)" class="col-5">
                                    <div class="h5 font-Raleway">@{{product.product_name}}</div>
                                    <small class=" ">/@{{product.sub_category_name}}</small>
                                </div>
                                <div @click="view_product(product)" class="col-2 font-Raleway">
                                    <div class="h6 text-muted" v-if="product.sale_price"><del>R@{{product.price}}</del></div>
                                    <div class="h5" v-else>R@{{product.price}}</div>
                                    <div class="h5" v-if="product.sale_price">R@{{product.sale_price}}</div>
                                </div>
                                <div class="col-2 d-flex">
                                    <div class="form-group">
                                        <label class="text-center font-Raleway">Qty</label>
                                       <select class="form-control" v-model="product.qty" name="" id="" @change="addCartQty(product)">   
                                         <option v-for="x in 100" :value="x" >@{{x}}</option>                                           
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-1   d-flex flex-column justify-content-center">

                                    <a @click="remove_from_cart(product)" class="text-danger c-pointer zoom">
                                         <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow p-3 text-center ">
                            <div class=" row  pb-3  border-bottom">
                                    <div class="col-12 h5 font-Raleway">
                                        Order Summary
                                    </div>
                             </div>
                             <div class="row w-100 py-2 h6 border-bottom">
                                <div class="  col-6  ">Cart</div>
                                <div class="  col-6  ">R@{{ cart_total }}</div>
                            </div>
                            <div class="row w-100 py-2 h6 border-bottom">
                                <div class="col-6 ">Discount</div>
                                <div class="col-6 ">-R@{{ discount_total }}</div>
                            </div>
                            <div class="row w-100 py-2 h6 border-bottom">
                                <div class="col-6 ">Delivery Fee</div>
                                <div class="col-6 ">R@{{ shipping_fee }}</div>
                            </div>
                            {{-- discount_total --}}
                            <div class="row py-2 w-100 h5 border-bottom">
                                <div class="col-6 ">Order Total</div>
                                <div class="col-6 ">R@{{ order_total }}</div>
                            </div>
                            <div class="row py-2 w-100 h5 border-bottom">
                                 <a href="{{ route('checkout') }}" class="btn btn-sm rounded btn-purple">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                    </div>
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
          total_stock_units: 0,
          cart: [],
          cart_productIDs: [],
          qty: 0,
          discount_total: 0,
          cart_qty: 0,
          cart_total: 0,
          order_total: 0,
          main_img: '',
          category: '',
          shipping_fee: 35,
         };
      },
      async created(){ 
 
         let product = [];
       
        // if no cart then create new empty cat
          if (!this.checkLocalStorage('cart')) {
              localStorage.setItem('cart', JSON.stringify([]));                
              localStorage.setItem('cart_productIDs', JSON.stringify([]));                
          }
          // always update the UI with data from local storage
          this.cart = JSON.parse(localStorage.getItem('cart'))
          this.cart_productIDs = JSON.parse(localStorage.getItem('cart_productIDs'))
 
          this.updateCartSummary();
          console.log( this.cart)
           
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
          updateCartSummary: function( ) {
            for (let i = 0; i < this.cart.length; i++) {
                this.cart_total += this.cart[i].qty * this.cart[i].price
                if (this.cart[i].sale_price > 0) {
                    this.discount_total += (this.cart[i].qty * this.cart[i].price ) - (this.cart[i].qty * this.cart[i].sale_price ) 
                    console.log(this.cart[i].sale_price)
                }  
             }
             this.order_total = (this.cart_total - this.discount_total) + this.shipping_fee;
          },
         changeImg: function(url){
              this.main_img = url;
          },
          checkLocalStorage: function(key){
              return localStorage.getItem(key) !== null;
          },
          remove_from_cart: function(product){
       
            this.cart = this.cart.filter(item => item.productID !== product.productID);
            this.cart_productIDs = this.cart_productIDs.filter(id => id !== product.productID);
            this.addCartQty()
           },
          addCartQty: function(item){
            this.cart_total = 0;
            this.order_total = 0;
            this.discount_total = 0;
            this.updateCartLocalStorage();
            this.updateCartSummary();
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