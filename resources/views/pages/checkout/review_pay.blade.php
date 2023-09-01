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
               <div class=" d-flex">
                <a  class="btn btn-sm   btn-outline-light rounded">1 Billing</a><span class="d-flex flex-column justify-content-center"><span class="step-arrow"></span></span>
                <a  class="btn btn-sm   btn-outline-light rounded">2 Shipping</a><span class="d-flex flex-column justify-content-center"><span class="step-arrow"></span></span>
                <a  class="btn btn-sm   btn-outline-purple rounded">3 Review & Pay</a>
               </div>
            </div>
            </div>
             <div class="  p-3">
                 
                <form name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post" class=" row">
                    @csrf
                        <div class="col-md-8">
                            <div class="w-100 m-0 pt-3  w-100 rounded border-bottom shadow py-5" v-if="cart.length < 1">
                                <p class="h5 text-muted text-center"><span>Your cart is empty...</span><br>
                                  <a href="/" class="btn btn-sm btn-outline-purple rounded">Go Shopping</a></p>
                              </div>
                              <div class="shadow rounded p-3">
                                   <div class="d-flex justify-content-between">
                                        <p class="h5">Billing Info:</p>    <div class="text-purple"> <a href="{{ route('checkout') }}" class="text-purple"><i class="fas fa-pencil-alt    "></i></a></div>
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
                                    <p class="h5">Shipping To: </p>   <div class="text-purple"><a href="{{ route('guest_shipping') }}" class="text-purple"><i class="fas fa-pencil-alt    "></i></a></div>
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
                                    <div class="col-6 ">R@{{ cart_total.toFixed(2) }}</div>
                                </div>
                                <div class="row w-100 py-2 h6 border-bottom">
                                    <div class="col-6 ">Discount</div>
                                    <div class="col-6 ">-R@{{ discount_total.toFixed(2) }}</div>
                                </div>
                                <div class="row w-100 py-2 h6 border-bottom">
                                    <div class="col-6 ">Delivery Fee</div>
                                    <div class="col-6 ">R@{{ shipping_fee.toFixed(2) }}</div>
                                </div>
                                {{-- discount_total --}}
                                <div class="row py-2 w-100 h5 border-bottom">
                                    <div class="col-6 ">Order Total</div>
                                    <div class="col-6 ">R@{{ order_total.toFixed(2) }}</div>
                                </div>
                                <div class="row py-2 w-100 h5 border-bottom" v-if="!loading">
                                    <button type="submit" class="btn btn-sm rounded btn-purple">
                                        <i class="fa fa-lock"></i> Pay now </button>
                                </div>
                                <div class="row pt-1 w-100 h6 border-bottom">
                                    {{-- <p class=""></p> --}}
                                    <p>Secured and powered by <span class="">Payfast</span> </p>
                                </div>
                                <div class="row py-1 w-100 h6 border-bottom">
                                    <div class="d-flex justify-content-around"> 
                                        <div class="px-2">
                                            <img height="15" src="https://cdn.visa.com/v2/assets/images/logos/visa/blue/logo.png" alt="">
                                        </div>
                                        <div class="px-2">
                                            <img height="15" src="https://www.mastercard.co.za/content/dam/public/mastercardcom/mea/za/logos/mc-logo-52.svg" alt="">
                                        </div> 
                                        <div class="px-2">
                                            <img height="15" src="https://www.payfast.co.za/eng/images/payment_methods/logo/InstantEFT@2x.png" alt="">
                                        </div>
                                        <div class="px-2">
                                            <img height="15" src="https://www.payfast.co.za/eng/images/payment_methods/logo/MobiCred@2x.png" alt="">
                                        </div>
                                        <div class="px-2">
                                            <img height="15" src="https://www.payfast.co.za/eng/images/payment_methods/logo/RCS@2x.png" alt="">
                                        </div>
                                    </div>
                                </div>
       
                            {{-- <form name="PayFastPayNowForm" action="https://www.payfast.co.za/eng/process" method="post"> --}}
                            <input required type="hidden" name="cmd" value="_paynow">
                            <input required type="hidden" name="receiver" pattern="[0-9]" value="22693275">
                            <input type="hidden" name="merchant_id" value="22693275">
                            <input type="hidden" name="merchant_key" value="wkz2p71vpunvf">
                            <input type="hidden" name="name_first" value="{{$user->first_name}}">
                            <input type="hidden" name="name_last" value="{{$user->last_name}}">
                            <input type="hidden" name="email_confirmation" value="1">
                            <input type="hidden" name="confirmation_address" value="info@mabebeza.com">
                            <input type="hidden" name="email_address" value="{{$user->email}}">
                            {{-- <input type="hidden" name="signature" value="{{$signature}}"> --}}
                            <input type="hidden" name="cell_number" value="0719273169">
                            <input type="hidden" name="return_url" id="return_url" value="https://mabebeza.co.za/checkout/payment/success/{{$user->id}}">
                            <input type="hidden" name="cancel_url" value="https://mabebeza.co.za/checkout/payment/failed/{{$user->id}}">
                            <input type="hidden" name="notify_url" value="https://www.example.co.za/notify">
                            <input required type="hidden" name="amount" id="payfast_order_total" v-model="order_total">
                            <input required type="hidden" name="item_name" maxlength="255" id="payfast_order_number" v-model="payfast_order_number">
                            <input type="hidden" name="item_description" maxlength="255" v-model="payfast_order_number">
                              
                    {{--  --}}
                             </div>
                        </div> 
                </form>
                     </div>
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
                loading: true,
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
              shipping_fee: 0,
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
              this.shipping_fee = JSON.parse(localStorage.getItem('shipping_fee'));
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

                try {
                    let order = await axios.post("{{ route('guest_update_order') }}", data);
                        order = order.data;
                } catch (error) {
                    console.error(error);
                } finally {
                    this.loading = false;
                }

                this.order_total = parseFloat(this.order_total).toFixed(2)

                // console.log(document.getElementById('return_url').value)
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
                //  this.discount_total = parseFloat(this.discount_total)
                //  this.cart_total = parseFloat(this.cart_total)
                 this.order_total = parseFloat(this.order_total)
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


                         {{--  --}}
<?php
/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
// function generateSignature($data, $passPhrase = null) {
//     // Create parameter string
//     $pfOutput = '';
//     foreach( $data as $key => $val ) {
//         if($val !== '') {
//             $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
//         }
//     }
//     // Remove last ampersand
//     $getString = substr( $pfOutput, 0, -1 );
//     if( $passPhrase !== null ) {
//         $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
//     }
//     return md5( $getString );
// }
// // // ////////////////////////////
// // // Construct variables
// $cartTotal = 1023.00; // This amount needs to be sourced from your application
// $passphrase = '22693275Merchantwkz2p71vpunvf';
// $data = array(
//     // Merchant details
//     'merchant_id' => '22693275',
//     'merchant_key' => 'wkz2p71vpunvf',
//     'receiver' => '22693275',
//     'merchant_key' => 'wkz2p71vpunvf',
//     'return_url' => 'https://mabebeza.com/accounts/checkout/payment/success',
//     'cancel_url' => 'https://mabebeza.com/accounts/checkout/payment/failed',
//     'notify_url' => 'http://www.yourdomain.co.za/notify.php',
//     // Buyer details
//     'name_first' => 'Amo',
//     'name_last'  => 'Madiba',
//     'email_address'=> 'amo@amomad.com',
//     // Transaction details
//     'm_payment_id' => '1234213124', //Unique payment ID to pass through to notify_url
//     'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
//     'item_name' => 'Order:4324'
// );

// $signature = generateSignature($data, $passphrase);
// $data['signature'] = $signature;

// // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
// $testingMode = false;
// $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
// $htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
// foreach($data as $name=> $value)
// {
//     $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
// }
// // $htmlForm .= '<input type="submit" value="Pay Now" /></form>';


?>