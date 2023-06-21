<x-app-layout>

    <div class="m-0  shadow rounded p-3  w-100" id="app">
        <div class="card border rounded w-100">
            <div class="d-flex justify-content-between  p-2">
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_info', [$product->product_productID])}}">Info</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_price', [$product->product_productID])}}">pricing</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded btn-outline-grey " href="{{route('product_update_vendor', [$product->product_productID])}}">Vendor</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_shipping', [$product->product_productID])}}">Shipping</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_media', [$product->product_productID])}}">Media</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded " href="{{route('product_update_publish', [$product->product_productID])}}">Publish</a></div>
                </div>
         </div>
         <hr>
     <form class=" " action="{{ route('product_save_vendor')}}" method="POST" >
        @csrf
    {{-- /////////////// --}} 
     <div class="card border rounded p-3 w-100">
        <div class="d-flex justify-content-center "><p class="font-weight-bold h5">Product Vendor</p></div>
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
        <div class=" row">
            <div class="col-md-6 p-2">
  
                <div class="form-group">
                  <label for="">Select Supplier</label>
                  <select class="form-control" name="supplier">
                    <option selected disabled>Select Supplier</option>

                    @foreach ($suppliers as $supplier)
                        @if ( $supplier->supplierID == $product->supplierID )
                           <option selected value="{{ $supplier->supplierID }}"> {{ $supplier->supplier_name}} {{ $supplier->company_name}}</option>
                           @else
                           <option value="{{ $supplier->supplierID }}"> {{ $supplier->supplier_name}} {{ $supplier->company_name}}</option>
                           @endif
                    @endforeach
                   </select>
                </div> 

            </div>
             
            <div class="col-md-6 p-2">
                <div class="form-group">
                   <label for="">Select Sub-category</label>
                   <select class="form-control" name="sub_category" >
                     <option selected disabled>Select sub-category</option>
                     @foreach ($sub_categories as $sub_category)
                         @if ( $sub_category->sub_categoryID == $product->sub_categoryID )
                         <option selected value="{{ $sub_category->sub_categoryID}}"> {{ $sub_category->sub_category_name}} {{ $supplier->company_name}}</option>
                         @else
                         <option value="{{ $sub_category->sub_categoryID}}"> {{ $sub_category->sub_category_name}} {{ $supplier->company_name}}</option>
                         @endif
                     @endforeach
                    </select>
                 </div> 
             </div>
        </div>
        <div class=" row">
            <div class="col-md-3 p-2 d-flex flex-column justify-content-center">
                {{-- <div class="form-check ">
                    <label class="form-check-label">
                        @if ($product->vat)
                        <input type="checkbox" class="form-check-input" name="vat" checked>
                        @else
                        <input type="checkbox" class="form-check-input" name="vat"  >
                        @endif
                        VAT Inclusive 
                    </label>
                  </div>  --}}
            </div>
              
            <div class="col-md-3 p-2">
                {{-- <div class="form-group">
                   <label for="">Sale Price</label>
                   <input type="number"  class="form-control" name="sale_price" value="{{ $product->sale_price }}"   placeholder="Optional">
                   <i class="text-muted small">Leave blank if no sale</i>
                   </div>  --}}
           </div>                 
             <div class="col-md-6 p-2">
                     {{-- <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Optional"  >
                     </div> --}}
             </div>
        </div> 
        <hr>
        <div class=" ">
            <button class="btn btn-sm rounded font-weight-bold w-100 btn-purple"> Save Product Vendor </button>
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

 let selected_files = document.getElementById('selected_files');
//  files.innerHTML = "AMo amo";
     let files = document.getElementById('files');
     let file = document.getElementById('file');

     let all_files = [];
     file.addEventListener('change', function(e) {  
        console.log(e.target.files[0]);
        all_files.push(e.target.files[0])
        console.log(all_files);
        files = all_files;
        selected_files.innerHTML +=   "<li>"+e.target.files[0].name+"</li><br/>";   //  "<li><img src="+e.target.files[0]+"/></li><br/>";     //+"<br/>";
        setTimeout(() => {
                file.value = ''
        }, 1000);
    });
 

let is_physical_product = document.getElementById('is_physical_product');
if (!is_physical_product.checked) {
        //  document.getElementById('shipping').classlist.add('d-none');
          document.getElementById('weight').disabled = true;
         document.getElementById('shipping_time_period').disabled = true;
    } else {
        //  document.getElementById('shipping').classlist.remove('d-none');
         document.getElementById('weight').disabled = false;
         document.getElementById('shipping_time_period').disabled = false;
    }
is_physical_product.addEventListener('change', function() {
    if (!is_physical_product.checked) {
        //  document.getElementById('shipping').classlist.add('d-none');
          document.getElementById('weight').disabled = true;
         document.getElementById('shipping_time_period').disabled = true;
    } else {
        //  document.getElementById('shipping').classlist.remove('d-none');
         document.getElementById('weight').disabled = false;
         document.getElementById('shipping_time_period').disabled = false;
    }
   
})


    </script>
</x-app-layout>
