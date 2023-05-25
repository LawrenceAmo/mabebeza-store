<x-app-layout>

    <div class="mx-0 mb-5  shadow rounded p-3  w-100" id="app">
        <div class="card border rounded w-100">
            <div class="d-flex justify-content-between  p-2">
                 <div class=""><a class="text-dark btn btn-outline-grey btn-sm rounded" href="{{route('product_update_info', [$product->product_productID])}}">Info</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_price', [$product->product_productID])}}">pricing</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_vendor', [$product->product_productID])}}">Vendor</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_shipping', [$product->product_productID])}}">Shipping</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_media', [$product->product_productID])}}">Media</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded " href="{{route('product_update_publish', [$product->product_productID])}}">Publish</a></div>
                </div>
         </div>
         <hr>
     <form class=" " action="{{ route('product_save_info', [$product->product_productID])}}" method="POST" >
        @csrf
        <div class="card border rounded p-3 w-100">
        <div class="d-flex justify-content-center "><p class="font-weight-bold h5">Product Information</p></div>
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
        <div class=" row">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product SKU/CODE <x-required></x-required></label>
                    <input type="text" class="form-control" name="code" value="{{ $product->sku }}" required placeholder="">
                    </div> 
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Name <x-required></x-required></label>
                    <input type="text" class="form-control" name="name" value="{{ $product->product_name }}" required placeholder="">
                    </div> 
            </div>
        </div>

        <div class=" row py-3">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Meta Title <x-required></x-required></label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}"   placeholder="">
                    </div> 
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Slug <x-required></x-required></label>
                    <input type="text" class="form-control" name="slug" value="{{ $product->slug }}"   placeholder="">
                    </div> 
            </div>
        </div>
  
        <div class=" row py-3">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Short Description</label>
                    <textarea class="form-control" name="description"   rows="3">{{$product->description}}</textarea>
                </div>
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Detailed information</label>
                    <textarea class="form-control" name="product_detail" placeholder="optional" id="" rows="3">{{$product->product_detail}}</textarea>
                    </div>
            </div>
        </div>
        <hr>
        
        <div class=" ">
            <button class="btn btn-sm rounded font-weight-bold w-100 btn-info"> Save Product Info </button>
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
