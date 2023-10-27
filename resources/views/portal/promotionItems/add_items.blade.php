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

    <main class="shadow rounded p-3" id="app" v-cloak>
         
     
    <hr>
    <div class="row mx-0 animated fadeInDown">
        <div class="col-12 text-center p-0 m-0">
            <p class="animated pulse w-100 pt-2 h5">@{{msg}}</p>
        </div>
     </div>
    <div class="card   rounded p-3 w-100" >
<div class=" pb-3  row">
   <span class="  col-md-2 ">All Products</span>
   <div class="col-md-4">
    <div class="form-group">
      {{-- <label for=""></label> --}}
      <input type="text" class="form-control" v-model="searchProductsText" v-on:keyup="SearchProducts($event)" placeholder="Search product by name">
      {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
    </div>
   </div>
  
   <div class="col-md-6 d-flex justify-content-end  ">
    <a href="{{ route('promotion_items', [$promotionID]) }}" class="btn btn-pink rounded btn-sm mx-2">Go back to promotion products</a>
    <a class="btn btn-purple rounded btn-sm mx-2" @click="save_added_items()">Save your changes</a>
    </div>
</div>
 <div class="tableFixHead" style="height: 500px;">
    <table class="table table-striped table-inverse table-responsive" >
        <thead class="thead-inverse  ">
            <tr class="bg-purple text-light">
                <th>#</th>
                <th>tick</th>
                <th>Code</th>
                <th>Name</th>
                <th>Cost Price</th>
                <th>Price</th> 
                {{-- <th>Sale Price</th>  --}}
                <th>Availability</th>
                <th>Published</th>
                {{-- <th>Action</th> --}}
            </tr>
            </thead>
            <tbody>  
                <tr v-for="product,i in products" @click="addItem(product.productID)">
                    <label :for="i" >
                        <td> @{{i+1}} </td>
                    <td> 
                        <input type="checkbox" :id="product.productID" name="" class="form-text form-control-sm text-muted">
                    </td>
                    <td>
                        @{{product.sku}}
                    </td>
                    <td>
                        @{{product.name}}
                    </td>
                    <td>
                        @{{product.cost_price}}
                    </td>
                    <td>
                        @{{product.price}}
                    </td>
                    {{-- <td>
                       <input type="number" class="form-text form-control-sm text-muted" :id="'price'+product.sku">                       
                    </td>                      --}}
                    
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
                    
                    </label>
                </tr>          

            </tbody>
    </table>
    <div class="rounded border shadow p-2 m-0 text-center h5 text-muted font-weight-bold " v-if="products.length < 1">No products available</div>
</div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelID" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @csrf
                <div class="modal-header ">
                    <h5 class="modal-title">@{{msg}}</h5>
                        <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>                
            </div>
        </div>        
    </div>

    {{-- //////////////////////////////////////////////////////////////////////////// --}}
 

     </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script> 
    <script>
     const { createApp } = Vue;
      createApp({
        data() {
          return {
            products: [],
            productsDB: [],
            promotion_items: [],           
            searchProductsText: '',
            msg: '',
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
                    products[ productID ]['name'] = productsDB[i].name;    
                    products[ productID ]['publish'] = productsDB[i].publish;    
                    products[ productID ]['availability'] = productsDB[i].availability;
                }
            }
            // console.log("////////////////////////////////////////")
            let filteredArray = products.filter(value => value !== "");

            this.stock_value = stock_value;
            this.products = [ ...filteredArray ];
            this.productsDB = [ ...filteredArray ];

            // Rearrange the remaining values
            let rearrangedArray = filteredArray.sort();
            this.total_stock_units = rearrangedArray.length ;
        },
        methods: {
            productUpdateUrl: function(val){
                var link = document.getElementById('productUpdateUrl');
                var href = link.getAttribute('data-href');
                href = href.replace('productID', val)
                location.href = href
            },
            save_added_items: async function(){
                let items = this.promotion_items;
                let data = await axios.post('{{route("promotions_add_items", [$promotionID])}}', {data: items} );  
                    // data = await data.status
                    if (data.status === 200) {
                        this.msg = 'Your changes were saved successful. This page will refresh in 5 seconds...'
                        $('#modelID').modal('show');

                        setTimeout(() => {
                            location.reload();
                        }, 5000);
                    }
                console.log(data);
            },
            addItem: function(id){
                let itemID = document.getElementById(id)
                 if (itemID.checked) { 
                     itemID.checked = false;
                     this.addItemDB(id, false)
                 } else {
                    itemID.checked = true; 
                    this.addItemDB(id, true)
                }   
                console.log(id);
             
            },
            addItemDB: function(itemID, type){
                if (type) {
                    if (!this.promotion_items.includes(itemID)) {
                        this.promotion_items.push(itemID)
                    }
                } else {
                    if (this.promotion_items.includes(itemID)) {
                        this.promotion_items = this.promotion_items.filter(item => item !== itemID);
                    }
                }
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

                      for (let i = 0; i < allProductsDB.length; i++) {
                          let productName = allProductsDB[i].name.toLowerCase();
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
