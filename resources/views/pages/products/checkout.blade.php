<x-guest-layout> 
<style>
    .step-arrow {
  display: inline-block;
  width: 50px;
  height: 2px;
  background-color: rgba(135, 135, 135, 0.203);
  margin: 0 10px;
}
</style>
    <main id="app">
     <section class="pb-5 pt-3">
      
      <div class="row">
        <div class="col-3">
            <a class="pl-3">/<a href="/">Home</a>/Checkout/Billing</a>
        </div>
        <div class="col-md-9 ">
           <div class=" ">
            <a  class="btn btn-sm   btn-outline-purple rounded">1 Billing</a><span class="step-arrow"></span>
            <a  class="btn btn-sm   btn-outline-light rounded">2 Shipping</a><span class="step-arrow"></span>
            <a  class="btn btn-sm   btn-outline-light rounded">3 Review & Pay</a>
           </div>
        </div>
        </div>
         <div class="  p-3">
             
                 <form action="{{ route('save_billing') }}" method="POST" class=" row">
                    @csrf
                    <div class="col-md-8">
                        <div class="w-100 m-0 pt-3  w-100 rounded border-bottom shadow py-5" v-if="!(cart)">
                            <p class="h5 text-muted text-center"><span>Your cart is empty...</span><br>
                              <a href="/" class="btn btn-sm btn-outline-info rounded">Go Shopping</a></p>
                          </div>
                          <div class="shadow rounded p-3"  >
                               <div class="">
                                    <p class="h5">Billing to:</p>
                               </div>
                               <div class="row mx-0 animated fadeInDown">
                                    <div class="col-12 text-center p-0 m-0">
                                        <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
                                    </div>
                                </div>
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">First Name</label> <br>
                                        <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control" placeholder="">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Last Name</label>
                                        <input type="text" name="last_name"value="{{$user->last_name}}" class="form-control" placeholder="">
                                    </div>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Email</label> <br>
                                        <input type="email" name="email"value="{{$user->email}}" class="form-control" placeholder="">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Mobile Number</label>
                                        <input type="text" name="phone" value="{{$user->mobile_phone}}" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Alternative Email</label> <br>
                                        <input type="email" name="alt_email"value="{{$user->alt_email}}" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Alternative Mobile Number</label>
                                        <input type="number" name="alt_phone"value="{{$user->alt_phone}}" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                </div>
                                <hr>
 
                               <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Street</label> <br>
                                        <input type="text" name="street"value="{{$user->street}}" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Suburb</label>
                                        <input type="text" name="suburb"value="{{$user->suburb}}" class="form-control" placeholder="" aria-describedby="prefixId">
                                    </div>
                               </div>
                               <div class="d-flex py-3 justify-content-between">
                                <div class="input-group px-3">
                                    <label class="input-group">Town/City</label> <br>
                                    <input type="text" name="city" value="{{$user->city}}" class="form-control" placeholder="Enter Town or City" aria-describedby="prefixId">
                                </div>
                                <div class="input-group px-3">
                                    <label class="input-group">Province</label>
                                    <input type="text" name="state"  value="{{$user->state ?? "Gauteng"}}" class="form-control" placeholder="Gauteng" aria-describedby="prefixId">
                                </div>
                               </div>
                                <div class="d-flex py-3 justify-content-between">
                                    <div class="input-group px-3">
                                        <label class="input-group">Country</label> <br>
                                        <input type="text" name="country"  value="{{$user->country ?? "South Africa" }}" class="form-control" placeholder="South Africa" aria-describedby="prefixId">
                                    </div>
                                    <div class="input-group px-3">
                                        <label class="input-group">Zip Code</label>
                                        <input type="number" name="zip_code" value="{{$user->zip_code}}" class="form-control" placeholder="Enter Zip Code" aria-describedby="prefixId">
                                    </div>
                                </div>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow p-3 text-center " >
                            <div class=" row  pb-3  border-bottom">
                                    <div class="col-12 h5">
                                        Order Summary
                                    </div>
                             </div>
                             <div class="row w-100 py-2 h6 border-bottom">
                                <div class="col-6 ">Cart</div>
                                <div class="col-6 ">R@{{ cart_total }}</div>
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
                                 <button type="submit" class="btn btn-sm rounded btn-purple"> <i class="fa fa-lock"></i> Save Billing</button>
                            </div>
  
                        </div>
                    </div>
                 </div>
          </div> 
     </section>
     <a data-href='{{ route('guest_view_product', ['category','product_name']) }}' id="view_product_url"></a>
     <input type="hidden" value='{{ $user->order_number }}' id="order_number">
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
 
         var order_number = document.getElementById('order_number').value;
         localStorage.setItem('orderID', order_number);                

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
          let data = { items: this.cart, order_number: order_number};
 
          let cart = await axios.post("{{ route('guest_update_cart') }}", data);

          console.log( await cart.data)  // not yet done 

        //   create cart 
           
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
                    // console.log(this.cart[i].sale_price)
                }  
             }
             this.order_total = (this.cart_total - this.discount_total) + this.shipping_fee;
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
            //  console.log(item)
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


 {{-- 
    
    
    <div class=""> 
                                <form name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post">
                                    <input required type="hidden" name="cmd" value="_paynow">
                                    <input required type="hidden" name="receiver" pattern="[0-9]" value="22693275">
                                    <input type="hidden" name="return_url" value="https://www.mabebeza.com/payments/success">
                                    <input type="hidden" name="cancel_url" value="https://www.mabebeza.com/payments/cancel">
                                    <input required type="hidden" name="amount" value="199">
                                    <input required type="hidden" name="item_name" maxlength="255" value="Pampers">
                                    <input type="hidden" name="item_description" maxlength="255" value="Pampers S1 min">
                                    <table>
                                    <tr>
                                    <td colspan=4 align=center>
                                          <input type="submit" name="" class="btn btn-sm rounded btn-info" value="Pay Now" alt="Pay Now" title="Pay Now with Payfast" >
                                    <input type="image" class="" src="https://my.payfast.io/images/buttons/PayNow/Light-Large-PayNow.png" >
                                    </td>
                                    </tr>
                                    </table>
                                    </form>
                            </div>
    
    --}}