<x-guest-layout> 

    <main id="app">
     <section class="pb-5 pt-3">
      <a class="pl-3">/<a href="/">Home</a>/Checkout</a>
         <div class="  p-3">
             
                 <div class=" row">
                    <div class="col-md-8">
                        <div class="w-100 m-0 pt-3  w-100 rounded border-bottom shadow py-5" v-if="cart.length < 1">
                            <p class="h5 text-muted text-center"><span>Your cart is empty...</span><br>
                              <a href="/" class="btn btn-sm btn-outline-info rounded">Go Shopping</a></p>
                          </div>
                          <div class="shadow rounded p-3">
                               <div class="">
                                    <p class="h5">Billing to:</p>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">First Name</label> <br>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Last Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Email</label> <br>
                                        <input type="email" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Phone Number</label>
                                        <input type="number" name="tel" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Street</label> <br>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Last Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                </div> --}}
                                <div class=" pt-5">
                                    <p class="h5">Address:</p>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Street</label> <br>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Surbub</label>
                                        <input type="text" name="tel" id="name" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                <div class="input-group px-3">
                                    <label class="input-group">Town/City</label> <br>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Town or City" aria-describedby="prefixId">
                                </div>
                                <div class="input-group px-3">
                                    <label class="input-group">Province</label>
                                    <input type="text" name="tel" value="Gauteng" class="form-control" placeholder="Gauteng" aria-describedby="prefixId">
                                </div>
                               </div>
                                <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Country</label> <br>
                                        <input type="text" name="name"  value="South Africa" class="form-control" placeholder="South Africa" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Zip Code</label>
                                        <input type="number" name="tel"  class="form-control" placeholder="Enter Zip Code" aria-describedby="prefixId">
                                    </div>
                                </div>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow p-3 text-center ">
                            <div class=" row  pb-3  border-bottom">
                                    <div class="col-12 h5">
                                        Order Summary
                                    </div>
                             </div>
                             <div class="row w-100 py-2 h6 border-bottom">
                                <div class="col-md-6">Cart</div>
                                <div class="col-md-6">R@{{ cart_total }}</div>
                            </div>
                            <div class="row w-100 py-2 h6 border-bottom">
                                <div class="col-md-6">Discount</div>
                                <div class="col-md-6">-R@{{ discount_total }}</div>
                            </div>
                            {{-- discount_total --}}
                            <div class="row py-2 w-100 h5 border-bottom">
                                <div class="col-md-6">Order Total</div>
                                <div class="col-md-6">R@{{ order_total }}</div>
                            </div>
                            <div class="row py-2 w-100 h5 border-bottom">
                                 <a href="" class="btn btn-sm rounded btn-info"> <i class="fa fa-lock    "></i> Pay Now</a>
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
             this.order_total = this.cart_total - this.discount_total
          },
         //  
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