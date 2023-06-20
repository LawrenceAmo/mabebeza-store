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
                <a class="pl-3">/<a href="/">Home</a>/Checkout/Review-and-Pay</a>
            </div>
            <div class="col-md-9 ">
               <div class=" ">
                <a  class="btn btn-sm   btn-outline-light rounded">1 Billing</a><span class="step-arrow"></span>
                <a  class="btn btn-sm   btn-outline-light rounded">2 Shipping</a><span class="step-arrow"></span>
                <a  class="btn btn-sm   btn-outline-info rounded">3 Review & Pay</a>
               </div>
            </div>
            </div>
             <div class="  p-3">
                 
                <form name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post" class=" row">
                    @csrf
                        <div class="col-md-8">
                            <div class="w-100 m-0 pt-3  w-100 rounded border-bottom shadow py-5" v-if="cart.length < 1">
                                <p class="h5 text-muted text-center"><span>Your cart is empty...</span><br>
                                  <a href="/" class="btn btn-sm btn-outline-info rounded">Go Shopping</a></p>
                              </div>
                              <div class="shadow rounded p-3">
                                   <div class="d-flex justify-content-between">
                                        <p class="h5">Billing Info:</p>    <div class=""> <a href="{{ route('checkout') }}" class="text-info"><i class="fas fa-pencil-alt    "></i></a></div>
                                   </div>
                                   <div class="row mx-0 animated fadeInDown">
                                    <div class="col-12 text-center p-0 m-0">
                                        <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
                                    </div>
                                </div>
                                <div class="">
                                    <table class="table">                                         
                                        <tbody>
                                            <tr>
                                                 <td>Names</td>
                                                <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            </tr>
                                            <tr>
                                                 <td>contacts</td>
                                                <td>{{$user->phone}} &nbsp; &nbsp; {{$user->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                 <div class="d-flex justify-content-between">
                                    <p class="h5">Shipping To: </p>   <div class=""><a href="{{ route('guest_shipping') }}" class="text-info"><i class="fas fa-pencil-alt    "></i></a></div>
                               </div>
                                <div class="">
                                    <table class="table">                                         
                                        <tbody>
                                            <tr>
                                                 <td>Recipient Names</td>
                                                <td>{{$shipping_addresses->first_name}} {{$shipping_addresses->last_name}}</td>
                                            </tr>
                                            <tr>
                                                 <td>Recipient contacts</td>
                                                <td>{{$shipping_addresses->phone}} &nbsp; &nbsp; {{$shipping_addresses->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Recipient Address</td>
                                               <td>{{$shipping_addresses->street}} &nbsp; {{$shipping_addresses->suburb}} &nbsp; {{$shipping_addresses->city}} &nbsp; {{$shipping_addresses->state}} &nbsp; {{$shipping_addresses->country}} &nbsp; {{$shipping_addresses->postal_code}} &nbsp;</td>
                                           </tr>
                                        </tbody>
                                    </table>
                                </div>
                                 
                            <hr>
                            <div class="">

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
                                    <button type="submit" class="btn btn-sm rounded btn-info">
                                        <i class="fa fa-lock"></i> Pay with payfast</button>
                                </div>
      
                    {{--  --}}
                            {{-- <form name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post"> --}}
                            <input required type="hidden" name="cmd" value="_paynow">
                            <input required type="hidden" name="receiver" pattern="[0-9]" value="22693275">
                            <input type="hidden" name="return_url" value="https://mabebeza.com/checkout/payment/success">
                            <input type="hidden" name="cancel_url" value="https://mabebeza.com/checkout/payment/failed">
                            <input required type="hidden" name="amount" id="payfast_order_total" v-model="order_total">
                            <input required type="hidden" name="item_name" maxlength="255" id="payfast_order_number" v-model="payfast_order_number">
                            <input type="hidden" name="item_description" maxlength="255" value="Pampers S1 min">
                            <table>
                            <tr>
                            <td colspan=4 align=center>
                                    {{-- <input type="submit" name="" class="btn btn-sm rounded btn-info" value="Pay Now" alt="Pay Now" title="Pay Now with Payfast" > --}}
                            {{-- <input type="image" class="" src="https://my.payfast.io/images/buttons/PayNow/Light-Large-PayNow.png" > --}}
                            </td>
                            </tr>
                            </table>
                            {{-- </form> --}}

                    {{--  --}}
                            </div>
                        </div>
                     </div>
                     @{{items_qty}}
              </div> 
         </section>
         <input type="hidden" value='{{ $order->order_number }}' id="order_number">

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
              items_qty: 0,
              cart_total: 0,
              order_total: 0,
              main_img: '',
              category: '',
              shipping_fee: 35,
              order_number: '',
              payfast_order_total: '',
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
     
              this.order_number = document.getElementById('order_number').value; 
              this.updateCartSummary(); 

            this.payfast_order_number = 'Order Number: '+this.order_number

            let data = { 
                items: this.cart,
                order_number: this.order_number,
                total_amount: this.order_total,
                discount_amount: this.discount_total,
                shipping_amount: this.shipping_fee,
                shipping_method: 'delivery',
                sub_total: this.cart_total,
                qty: this.items_qty,
                };
            let order = await axios.post("{{ route('guest_update_order') }}", data);
            console.log( order.data)
               
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
                    }  
                    this.items_qty += this.cart[i].qty;
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
                //   console.log(href)
    
                  href = href.replace('category', sub_category_name )
                  let product_name = item.product_name.replace(/ /g, '-')+'-'+item.productID
                  href = href.replace('product_name', product_name )
     
                   location.href = href
     
                // console.log(href);
                // console.log(item);
     
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