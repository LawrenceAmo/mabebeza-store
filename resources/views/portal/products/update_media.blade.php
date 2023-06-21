<x-app-layout>

    <div class="m-0  mb-5 shadow rounded p-3  w-100" id="app">
        <div class="card border rounded w-100">
            <div class="d-flex justify-content-between  p-2">
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_info', [$product[0]->product_productID])}}">Info</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_price', [$product[0]->product_productID])}}">pricing</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded  " href="{{route('product_update_vendor', [$product[0]->product_productID])}}">Vendor</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_shipping', [$product[0]->product_productID])}}">Shipping</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded btn-outline-grey" href="{{route('product_update_media', [$product[0]->product_productID])}}">Media</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded " href="{{route('product_update_publish', [$product[0]->product_productID])}}">Publish</a></div>
            </div>
         </div>
         <hr>
     <form class=" " action="{{ route('product_save_media')}}" enctype="multipart/form-data" method="POST" >
        @csrf
        
    {{-- /////////////// --}}
     <div class="card border rounded p-3 w-100">
        <div class="d-flex justify-content-center "><p class="font-weight-bold h5">Product Media</p></div>
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div> 
        <div class="">
            <p class="">Please Insert Thumbnail</p>
        </div>
        
        <div class=" row   pb-3">

            <div class="col-md-6 p-2">
                 
                <div class="form-group">
                    <label for="">Please Enter Image Title/Meta-Data</label>
                    <input type="text" name="thumnail_title" class="form-control" placeholder=" "  >
                 </div>

            </div> 
            <div class="col-md-6 p-2">
                <div class="form-group">
                    <label for="">Choose product Image</label>
                    <input type="file" name="thumnail"   class="form-control" placeholder=" "  >
                 </div>
             </div>
        </div>
         
        <hr>

        <div class="">
            <p class="">Please Insert Main Image</p>
        </div>
        <div class=" row   pb-3">

            <div class="col-md-6 p-2">
                 
                <div class="form-group">
                    <label for="">Please Enter Image Title/Meta-Data</label>
                    <input type="text" name="main_title" class="form-control" placeholder=" "  >
                 </div>

            </div> 
            <div class="col-md-6 p-2">
                <div class="form-group">
                    <label for="">Choose  Image</label>
                    <input type="file" name="main"   class="form-control" placeholder=" "  >
                 </div>
             </div>
        </div>
         
        <hr>
        <div class="">
            <p class="">Please Insert Supporting Image</p>
        </div>
        <div class=" row   pb-3">

            <div class="col-md-6 p-2">
                 
                <div class="form-group">
                    <label for="">Please Enter Image Title/Meta-Data</label>
                    <input type="text" name="image_title" class="form-control" placeholder="Optional"  >
                 </div>

            </div> 
            <div class="col-md-6 p-2">
                <div class="form-group">
                    <label for="">Choose product Image</label>
                    <input type="file" name="image" class="form-control" placeholder="Optional"  >
                 </div>
             </div>
        </div>
         
        <hr>
        <div class=" ">
            <button class="btn btn-sm rounded font-weight-bold w-100 btn-purple"> Upload Product Images </button>
        </div>

        <hr>
        <div class="border rounded p-3">
            <p class="h5">Uploaded Images</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Title</th>
                         
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $item)                        
                    @if ( $item->thumbnail )
                    {{-- main --}}
                        <tr>
                            <td scope="row font-weight-bold">Thumbnail</td>
                            <td>
                                <div class="">
                                    <div class="">
                                        <img src="{{ asset('storage/products/'.$item->url)  }}" height="50" alt="">
                                    </div>
                                    <small class="text-muted">
                                        {{ $item->url}}
                                    </small>
                                </div>
                            </td>
                             <td>{{ $item->title}}</td>
                        </tr>
                    @endif
                    @if ( $item->main )
                        <tr>
                            <td scope="row font-weight-bold">Main</td>
                            <td>
                                <div class="">
                                    <div class="">
                                        <img src="{{ asset('storage/products/'.$item->url)  }}" height="50" alt="">
                                    </div>
                                    <small class="text-muted">
                                        {{ $item->url}}
                                    </small>
                                </div>
                            </td>
                             <td>{{ $item->title}}</td>
                        </tr>
                    @endif 
                    @if ( !$item->main && !$item->thumbnail)
                        <tr>
                            <td scope="row font-weight-bold">Supporting</td>
                            <td>
                                <div class="">
                                    <div class="">
                                        <img src="{{ asset('storage/products/'.$item->url)  }}" height="50" alt="">
                                    </div>
                                    <small class="text-muted">
                                        {{ $item->url}}
                                    </small>
                                </div>
                             <td>{{ $item->title}}</td>
                        </tr>
                    @endif      
                    @endforeach

                </tbody>
            </table>
         
        </div>
    </div>
    <input type="hidden" class="form-control" name="productID" value="{{ $product[0]->product_productID }}" required placeholder="">

  

         
</form> <hr>
<div class="my-5">

</div>
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
