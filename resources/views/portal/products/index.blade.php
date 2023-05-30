<x-app-layout>
    <style>
        a:hover {
            text-decoration: none;
        }
        .categories{
          background-color: rgb(59, 59, 59)  !important;
          color: aliceblue  !important;
          font-size: 900px !important;
        }
  
        .tableFixHead          { overflow: auto !important;    }
        .tableFixHead thead th { position: sticky !important; top: 0 !important; z-index: 1 !important;background-color: rgb(37, 37, 37)  !important; }
  
         table  { border-collapse: collapse; width: 100% !important; }
        th, td { padding: 8px 16px; }
   
    </style>

    <main class="shadow rounded p-3" id="app">
        
    <div class="  row bg-white shadow m-0   rounded p-3 w-100">
         
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">Stock Value <span>R@{{stock_value}}</span></p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center"> Out of Stock  <span>R?</span></p>
             </div>
        </div>
        {{-- <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">  Earnings <span>R2342</span></p>
             </div>
        </div> --}}
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">Total Products <span>@{{total_stock_units}}</span></p>
             </div>
        </div>

        
    </div>
    <hr>
    <div class="row mx-0 animated fadeInDown">
        <div class="col-12 text-center p-0 m-0">
            <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
        </div>
     </div>
    <div class="card   rounded p-3 w-100" >
<p class="font-weight-bold h4 d-flex justify-content-between">
   <span> All Products  </span> <a class="btn btn-info rounded btn-sm" data-toggle="modal" data-target="#modelId">add new product</a>
</p>
{{-- href="{{ route('create_product')}}" --}}
 <div class="tableFixHead" style="height: 500px;">
    <table class="table table-striped table-inverse table-responsive" >
        <thead class="thead-inverse">
            <tr class="border font-weight-bold shadow bg-dark text-light rounded ">
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Cost Price</th>
                <th>Price</th>
                <th>Total Inventory</th>
                <th>Availability</th>
                <th>Published</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>  
                <tr v-for="product,i in products">
                    <td> @{{i+1}} </td>
                    <td>
                        @{{product.sku}}
                    </td>
                    <td>
                        @{{product.product_name}}
                    </td>
                    <td>
                        @{{product.cost_price}}
                    </td>
                    <td>
                        @{{product.price}}
                    </td>
                    <td  >
                        R@{{product.stock_value || 0}}
                    </td>
                    <td  >
                         <span v-if="product.availability">
                            Yes
                        </span>
                        <span v-else>
                            No
                        </span>
                    </td>
                    <td  >
                        <span v-if="product.publish">
                           Yes
                       </span>
                       <span v-else>
                           No
                       </span>
                   </td>
                   <td class=" px-0">
                     <a data-href='{{ route('product_update_info', ['productID']) }}' @click="productUpdateUrl(product.productID )" id="productUpdateUrl" class="px-1 text-info c-pointer"><i class="fas fa-pencil-alt  "></i></a> |
                     <a href="" class="px-1 text-danger"><i class="fas fa-trash-alt    "></i></a>
                </td>
                </tr>          
                {{-- @foreach ($products as $product)
                 <tr>
                    <td scope="row">{{$i}}</td>
                    <td><img src="{{ asset('images/products/img.jpg') }}" alt="" style="height: 60px;"></td>
                    <td>{{$product->product_name}}</td>
                    <td>R{{$product->cost_price}}</td>
                    <td>R{{$product->price}}</td>
                    <td>R{{$product->quantity}}</td> 
                    <td>
                        @if ($product->availability)
                            <span class="">Yes</span>
                        @else
                            <span class="">No</span> 
                        @endif
                    </td>
                    <td>
                        @if ($product->publish)
                            <span class="">Yes</span>
                        @else
                            <span class="">No</span> 
                        @endif
                        </td>
                     <td class=" px-0">
                        <a href="{{ route('product_update_info', [$product->productID]) }}" class="px-1 text-info"><i class="fas fa-pencil-alt    "></i></a> |
                         <a href="" class="px-1 text-danger"><i class="fas fa-trash-alt    "></i></a>
                    </td>
                </tr>
                 @endforeach             --}}
            </tbody>
    </table>
</div>
    </div>
 
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('create_product')}}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header ">
                    <h5 class="modal-title">Create Sub Category</h5>
                        <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body"> 
                <div class="">
                        <div class="form-group py-2">
                            <label for="">Product Barcode</label>
                            <input type="text" name="code"  class="form-control" placeholder="Enter barcode"  >
                        </div>
                        <div class="form-group py-2">
                            <label for="">Product Name</label>
                            <input type="text" name="product_name"  class="form-control" placeholder="Enter Category Name"  >
                        </div>
                                              
                        {{-- <div class="form-group py-3">
                            <label for="">Select Sub Category</label>
                            <select class="form-control" name="sub_category" >
                                <option selected disabled >Select Category </option>                              
                                @foreach ($sub_categories as $category)
                                    <option value="{{$category->sub_categoryID}}">{{$category->sub_category_name}}</option>                              
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group py-3">
                            <label for="">Select Supplier</label> 
                            <select class="form-control" name="supplier" id="">
                                <option selected disabled >Select Supplier </option>                              
                                @foreach ($suppliers as $supplier)                            
                                    <option value="{{$supplier->supplierID}}">{{$supplier->supplier_name}} {{$supplier->company_name}}</option>                              
                                @endforeach
                            </select>
                        </div> --}}

                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm rounded btn-primary">create product</button>
                </div>
            </form>
        </div>
        
    </div>
 
     </main>
    <script>
        // {{$products}}
             const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            product_price: '',
            products: '',
            margin: '',
            stock_value: 0,
            total_stock_units: 0,
           };
        },
        async created(){
            let productsDB = @json($products);
            console.log(productsDB)
 
            this.products = productsDB
            let productIDs =[];
            let products =[];
            let stock_value =0;
            for (let i = 0; i < productsDB.length; i++) {
                let productID = productsDB[i].productID;

                if (!productIDs.includes(productID)) {
                    products[ productID ] = [];   // add array of sales for this code
                    productIDs.push(productID);
                    products[ productID ]['productID'] =productID;   // add array of sales for this code
                    products[ productID ]['sku'] = productsDB[i].sku;    
                    products[ productID ]['cost_price'] = productsDB[i].cost_price;    
                    products[ productID ]['price'] = productsDB[i].price;    
                    products[ productID ]['product_name'] = productsDB[i].product_name;    
                    products[ productID ]['publish'] = productsDB[i].publish;    
                    products[ productID ]['availability'] = productsDB[i].availability;    
                    products[ productID ]['stock_value'] = 0; //productsDB[i].stock_value;    
                    products[ productID ]['inventory'] = []; //productsDB[i].stock_value;    
  
                }
                products[ productID ]['stock_value'] += Number(productsDB[i].stock_value);    
                products[ productID ]['inventory'].push( { store:productsDB[i].store_name, qty: Number(productsDB[i].stock_value) } ) //productsDB[i].stock_value;    
                stock_value += Number(productsDB[i].stock_value)
            }
            console.log("////////////////////////////////////////")
            console.log(products)
            this.stock_value = stock_value
            this.products = [ ...Object.values(products) ]
            this.total_stock_units = products.length;
 
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
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                // link.setAttribute('href', href + '/' + val);
                 location.href = href
            }
        }

     }).mount("#app");

   
    </script>
</x-app-layout>
