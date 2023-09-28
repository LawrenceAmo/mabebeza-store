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
             <div class="card p-3 border border-light">
                <p class="font-weight-bold h5 text-center">Stock Value <span>R@{{stock_value.toFixed(2)}}</span></p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="card p-3 border border-light">
                <p class="font-weight-bold h5 text-center"> Total Products <span>@{{total_stock_units}}</span></p>
             </div>
        </div>

        <div class="col-md-4">
             <div class="card p-2 border border-light btn btn-purple" @click="update_stock()">
                <p class="font-weight-bold h5 text-center  "  id="update_stock">Update Stock</p>
                {{-- <i class=""><small>last update: 2023-07-18 15:13:05</small></i> --}}
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
<div class=" pb-3  row">
   <span class="  col-md-3 "> All Products  </span>
   <div class="col-md-5">
    <div class="form-group">
      {{-- <label for=""></label> --}}
      <input type="text" class="form-control" v-model="searchProductsText" v-on:keyup="SearchProducts($event)" placeholder="Search product by name">
      {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
    </div>
   </div>
   <div class="col-md-4 d-flex justify-content-around">
   <a class="btn btn-purple rounded btn-sm" data-toggle="modal" data-target="#modelId">add new product</a>
   <a class="btn btn-pink rounded btn-sm"  @click="download_stock_list()">Download products</a>
   </div>
</div>
 <div class="tableFixHead" style="height: 500px;">
    <table class="table table-striped table-inverse table-responsive" >
        <thead class="thead-inverse  ">
            <tr class="bg-purple text-light">
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Cost Price</th>
                <th>Price</th>
                <th>Tembisa Inventory</th>
                <th>Bambanani Inventory</th>
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
                    <td  :title="'qty: '+product.tembisa"> 
                        R@{{(product.tembisa * product.cost_price).toFixed(2)  }}
                    </td>
                    <td  :title="'qty: '+product.bambanani"> 
                        R@{{ (product.bambanani * product.cost_price).toFixed(2)  }}
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
                     <a data-href='{{ route('product_delete', ['productID']) }}' @click="productDeleteUrl(product.productID )" id="productDeleteUrl" class="px-1 text-danger c-pointer"><i class="fas fa-trash-alt    "></i></a> 
                </td>
                </tr>          

            </tbody>
    </table>
    <div class="rounded border shadow p-2 m-0 text-center h5 text-muted font-weight-bold " v-if="products.length < 1">No products available</div>
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
                            <input type="text" name="product_name"  class="form-control" placeholder="Enter Product Name"  >
                        </div>                                     
                     
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm rounded btn-primary">create product</button>
                </div>
            </form>
        </div>
        
    </div>

     </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script> 
    <script>
     const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            product_price: '',
            products: [],
            productsDB: [],
            margin: '',
            stock_value: 0,
            total_stock_units: 0,
            searchProductsText: '',
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
                    products[ productID ]['tembisa'] = 0; 
                    products[ productID ]['bambanani'] = 0; 
                    products[ productID ]['inventory'] = []; 
                }

                products[ productID ]['stock_value'] += Number(productsDB[i].quantity);  
               // Check if the store_name includes 'embisa' or 'ega'
                if (productsDB[i].store_name.includes('embisa') || productsDB[i].store_name.includes('ega')) {
                     products[productID]['tembisa'] = Number(productsDB[i].quantity); 
                }
                if (productsDB[i].store_name.includes('nani') || productsDB[i].store_name.includes('oot')|| productsDB[i].store_name.includes('doc')) {
                    products[ productID ]['bambanani'] = Number(productsDB[i].quantity); 
                }  
                products[ productID ]['inventory'].push(  { store:productsDB[i].store_name, qty:Number(productsDB[i].quantity)}  )  
                // stock_value += Number(productsDB[i].stock_value) store_name
            }
            // console.log("////////////////////////////////////////")
            let filteredArray = products.filter(value => value !== "");

            this.stock_value = stock_value;
            this.products = [ ...filteredArray ];
            this.productsDB = [ ...filteredArray ];


            // Rearrange the remaining values
            let rearrangedArray = filteredArray.sort();
            this.total_stock_units = rearrangedArray.length ;
            // console.log( "this.products")
            // console.log( this.products)
            // console.log( this.productsDB)

        },
        methods: {
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            },
            productDeleteUrl: function(val){
                var link = document.getElementById('productDeleteUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            },
            update_stock: async function(){
                let update_stock_btn = document.getElementById('update_stock');
                    update_stock_btn.innerHTML = 'Pulling stock from Dashboard...';
                let stock = await axios.get('https://stokkafela.com/api/mabebeza/products');  
                    stock = await stock.data
                    
                    update_stock_btn.innerHTML = 'Updating stock please wait...';

                let data = await axios.post('{{route("update_stock")}}', stock );  
                    data = await data.data
                console.log(data);
                update_stock_btn.innerHTML = 'Stock Updated';

            },
            SearchProducts: function(event) {
                      let allProductsDB = this.productsDB;
                      let searchWords = this.searchProductsText.toLowerCase().split(/\s+/); // Split by whitespace

                      this.products = [];
                      if (searchWords[0].length < 1) {
                          this.products = [ ...allProductsDB ]
                          return false;
                      } 
                      console.log(searchWords)
                      console.log(searchWords)

                      for (let i = 0; i < allProductsDB.length; i++) {
                          let productName = allProductsDB[i].product_name.toLowerCase();                          
                          // Use every() to check if all search words are present in the product name
                          if (searchWords.every(word => productName.includes(word))) {
                              this.products.push(allProductsDB[i]);
                          }
                      }   
                      return false; 
                  },
        download_stock_list: function(){   // Not yet done
            
        let dataDB = this.productsDB;
        let data = []
 
              for (let i = 0; i < dataDB.length; i++) {
                  let product  = {}
                  product['Barcode'] = dataDB[i].sku
                  product['Description'] = dataDB[i].product_name
                  product['Cost Price'] = { f: 'ROUND('+dataDB[i].cost_price+',2)' , t: 'n' } 
                  product['Selling Price'] =  { f: 'ROUND('+dataDB[i].price+',2)' , t: 'n' }  
                  product['Tembisa Stock Value'] =  { f: 'ROUND('+dataDB[i].tembisa * dataDB[i].cost_price+',2)' , t: 'n' }  
                  product['Bambanani Stock Value'] =  { f: 'ROUND('+dataDB[i].bambanani * dataDB[i].cost_price+',2)' , t: 'n' }  
                 //   product['Physical Count'] =  0
                //   product['Variance'] =  { f: 'F2-E2', t: 'n' } 
                //   product['Physical Count Value'] =  { f: 'F2*C2', t: 'n' }
                //   product['Stock Value Variance'] =  { f: 'G2*C2', t: 'n' }             //parseFloat((0 - dataDB[i].stock_value)).toFixed(2)    
                //   product['Stock Value'] = { f: 'E2*C2', t: 'n' }                       //parseFloat(dataDB[i].stock_value).toFixed(2)
                //   product[first_month] =  { f: 'ROUND('+dataDB[i].first_month+',2)' , t: 'n' }  
                //   product[second_month] =  { f: 'ROUND('+dataDB[i].second_month+',2)' , t: 'n' }  
                //   product[last_month] =  { f: 'ROUND('+dataDB[i].last_month+',2)' , t: 'n' } 
                //   product['Total 3 Month Sales'] = { f: '(K2+L2+M2)', t: 'n' } 
                //   product['Average Run Rate'] = { f: 'IFERROR(ROUND((N2/3),2),0)', t: 'n' }                     //parseFloat(dataDB[i].avr_rr).toFixed(2)
                //   product['Days onHand'] =   { f: 'IFERROR(ROUND(((J2/O2)*30.5),0),0)', t: 'n' }                  //dataDB[i].days_onhand 
                //   product['Suggested Order Value'] = { f: 'IFERROR(ROUND((21-P2)*(O2/21),2),0)', t: 'n' }          //parseFloat(dataDB[i].suggested_order).toFixed(2)
                //   product['Suggested Order Qty'] = { f: 'IFERROR(ROUND((Q2/C2),0),0)', t: 'n' }         //!isNaN( parseFloat(dataDB[i].suggested_order / item[i].avrgcost)) ? parseFloat(dataDB[i].suggested_order /  dataDB[i].avrgcost).toFixed(0) : 0 
                //   product['Sku Rank %'] = { f: 'IFERROR(ROUND((N3/N$2),2),0)', t: 'e' }  
                //   product['Cumulative Contribution'] = { f: 'S3+T2', t: 'e' }  

                 data.push(product)               
                }  
            let workbook = XLSX.utils.book_new();
            let worksheet = XLSX.utils.json_to_sheet(data);  

            // Set the column width for columns A and B
            const columnWidths = { A: 15, B: 40 }; // Adjust widths as needed
            worksheet['!cols'] = [];
            Object.keys(columnWidths).forEach(col => {
              worksheet['!cols'].push({ wch: columnWidths[col] });
            });

            // // Apply bold and text wrapping for the entire row (columns A to T)
             for (let col = 0; col < 5; col++) {
              const cellRef = XLSX.utils.encode_cell({ r: 0, c: col });  // Cell reference for the cell in the row
              worksheet[cellRef] = worksheet[cellRef] || { s: {} };
              worksheet[cellRef].s =  { font: { bold: true }, alignment: { wrapText: true } };
            }
 
            XLSX.utils.book_append_sheet(workbook, worksheet, ' Mabebeza online stocklist');          
            // console.log(data);
     
            try {
                XLSX.writeFile(workbook, 'Mabebeza online stocklist .xlsx');
                // $('#ship_to_modal').modal('show');
                console.log('File successfully written.');
            } catch (error) {
                console.error('Error writing the file:', error);
            } 
          },
        }
     }).mount("#app"); 
    </script>
</x-app-layout>
