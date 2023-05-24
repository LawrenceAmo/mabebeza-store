<x-app-layout>
    <style>
        .product-img{
            height: 80px;
        }
    </style>
    <main class=" shadow rounded p-3" id="app">
         <div class="card p-3">
            <p class="">a</p>
                    </div>
                    <hr>
                    <div class="card p-3 ">

                        <div class="pt-3">
                            <p class="h4 font-weight-bold">5G Uncapped Networks</p>
                        </div>
            <hr>
           <div class="row mx-md-3 w-100">
                 
                <div class=" col-md-3 col-sm-6 p-3 ">
                    <div class="card border my-2 p-2">
                        <div class=" border border-info rounded product-img" >
                            <p> </p>
                        </div> 
                        <div class="pt-2 " v-for="product,i in products">
                            <div class=""><span>5G Standerd - Uncapped</span></div>
                            <div class=" font-weight-bold d-flex justify-content-end">
                                <span class="font-weight-bold">R549 <small>pm</small></span></div>
                        </div>
                        <div class="border-top pt-2">
                            <div class="d-flex justify-content-between">
                                <div class=" text-danger"><a href="" class="text-danger"><i class="far fa-heart" aria-hidden="true"></i></a></div>
                                <div class=" "><a href="" class="text-info"> <i class="fas fa-eye    "></i> </a></div>
                                
                                <div class=" text-danger"><a href="" class=" btn btn-sm rounded btn-outline-info font-weight-bold">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Get it Now</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
                
           </div>

        </div>
        {{--  --}}
     </main>
    <input type="hidden"   id="products" value="{{ $products }}">

    <script>
        
const { createApp } = Vue;
      createApp({
        data() {
          return {
            // product: $products,           
            products: [],           
        };
        },
        async created(){
            let products = JSON.parse(document.getElementById("products").value);
            // let products =" document.getElementById('products').value";
            console.log("amo start pricing")
            console.log(products)
             this.products = products
        },
        methods: { 
            pricing: function(){
           
            }
        }

     }).mount("#app");


    </script>
</x-app-layout>