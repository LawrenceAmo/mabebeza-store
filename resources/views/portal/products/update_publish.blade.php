<x-app-layout>

    <div class="m-0  shadow rounded p-3  w-100" id="app">
        <div class="card border rounded w-100">
            <div class="d-flex justify-content-between  p-2">
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_info', [$product->product_productID])}}">Info</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_price', [$product->product_productID])}}">pricing</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_vendor', [$product->product_productID])}}">Vendor</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_shipping', [$product->product_productID])}}">Shipping</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_media', [$product->product_productID])}}">Media</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded btn-outline-grey" href="{{route('product_update_publish', [$product->product_productID])}}">Publish</a></div>
                </div>
         </div>
         <hr>
     <form class=" " action="{{ route('product_save_publish')}}" method="POST" >
        @csrf

    {{-- /////////////// --}}
     <div class="card border rounded p-3 w-100">
        <div class="d-flex justify-content-center "><p class="font-weight-bold h5">Product Activation</p></div>
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>

         <div class=" d-flex justify-content-between   rounded">
            @if ($product->type == 'featured')                 
                <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="product_type" id="" value="featured" checked >
                        Featured Products
                    </label>
                </div>                
            @else
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="product_type" id="" value="featured"   >
                    Featured Products
                  </label>
                </div>
            @endif
            {{--  --}}

            @if ($product->type == 'new')                 
                <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="product_type" id="" value="new" checked >
                        New Products
                    </label>
                </div>                
            @else
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="product_type" id="" value="new"   >
                    New Products
                  </label>
                </div>
            @endif
           {{-- /////// --}}
           @if ($product->type == 'sale')                 
                <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="product_type" id="" value="sale" checked >
                        Sales Products
                    </label>
                </div>                
            @else
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="product_type" id="" value="sale"   >
                    Sales Products
                    </label>
                </div>
            @endif
{{-- ////// --}}

            @if ($product->type == 'other')                 
            <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="product_type" id="" value="other" checked >
                    Other Products
                </label>
            </div>                
            @else
            <div class="form-check">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="product_type" id="" value="other"   >
                Other Products
                </label>
            </div>
            @endif
 
         </div>
        
        <div class=" row">
            <div class="col-md-4 p-2 d-flex flex-column justify-content-center">
                <div class="form-check border-bottom py-3 ">
                    <label class="form-check-label">
                        @if ($product->sale)
                        <input type="checkbox" class="form-check-input" name="sale" checked>
                        @else
                        <input type="checkbox" class="form-check-input" name="sale"  >
                        @endif
                        Activate Sale
                    </label>
                  </div> 
                  <div class="form-check border-bottom  py-3">
                    <label class="form-check-label">
                        @if ($product->availability)
                        <input type="checkbox" class="form-check-input" name="availability" checked>
                        @else
                        <input type="checkbox" class="form-check-input" name="availability"  >
                        @endif
                        Is Product Available?
                    </label>
                  </div> 
                  <div class="form-check  border-bottom border-left  py-3">
                    <label class="form-check-label">
                        @if ($product->publish)
                        <input type="checkbox" class="form-check-input" name="publish" checked>
                        @else
                        <input type="checkbox" class="form-check-input" name="publish"  >
                        @endif
                        Publish Product
                    </label>
                  </div> 
            </div>
              
            <div class="col-md-8 float-right border-bottom rounded p-3">
                <div class="">

                    <strong class="small ">Activate Sale</strong>
                    <p class="small">Click on the <strong>Activate Sale</strong> button to initiate the process of making your product available for purchase.</p>
                    
                    <strong class="small ">Check Availability</strong>
                    <p class="small">Make sure your product is in stock and ready to be shipped before proceeding. Ensure that you have sufficient inventory.</p>
                    
                    <strong class="small ">Publish Product</strong>
                    <p class="small">Click on the <strong>Publish Product</strong> button to showcase your product to customers.</p>
                    
   
                </div>
           </div>                 
             
        </div> 
        <hr>
        <div class=" ">
            <button class="btn btn-sm rounded font-weight-bold w-100 btn-purple"> Publish Product   </button>
        </div>
    </div>
    <input type="hidden" class="form-control" name="productID" value="{{ $product->product_productID }}" required placeholder="">

  

         
</form>
     </div>
    <script>
             const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            product_price: '',
            profit: '',
            margin: '',
            margin_value: 0,
           };
        },
        async created(){
            console.log("amo start pricing")
        },
        methods: {
            margin_type: function(margin_type_v){
                let margin_value = 0;
                if (margin_type_v == "percent") {
                    margin_value = (this.margin / 100) * this.vendor_product_price;
                }else{
                margin_value = this.margin; 
                }
                // console.log(margin_type_v +" ============ "+ margin_value)
                 this.margin_value = margin_value;
            },
            pricing: function(){
                            console.log(this.margin_value)
                            // console.log(this.margin_in_rand)

                // this.product_price = this.margin_type + this.vendor_product_price
            }
        }

     }).mount("#app");
 
    </script>
</x-app-layout>
