<x-app-layout>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script> --}}
{{-- <link rel="stylesheet" href="{{asset('/css/index.css')}}"> --}}
 
<style>
    
    #qrcode canvas{
        height: 200 !important;
    }
    .tableFixHead          { overflow: auto !important;    }
        .tableFixHead thead th { position: sticky !important; top: 0 !important; z-index: 1 !important;background-color: rgb(37, 37, 37)  !important; }
  
         table  { border-collapse: collapse; width: 100% !important; }
        th, td { padding: 8px 16px; } 
</style>
    <main class="m-0  px-4 py-5   w-100" id="app">
         
    <div class="card border rounded p-3 w-100 table-responsive">
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
         <div class="card rounded " >
            <div class="d-flex   py-3" style="height:200px;">
                <div class="col-md-6 d-flex flex-column justify-content-center border-right">
                   <div class="text-center my-0 ">
                     <label for="" class="text-muted font-weight-bold">Enter text to generate QR Code</label>
                        <input type="text" onkeyup="text();" id="text" value="www.mabebeza.com" class="form-control  " style="border-left: 0px; border-top: 0px; border-right: 0px;">
                   </div>
                </div>
                <div class="col-md-6 border-left d-flex justify-content-center">
                    <div id="qrcode" class=""  ></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="pb-3">
            <div class="  d-flex justify-content-end">
                <a class="btn btn-purple rounded btn-sm mx-3" data-toggle="modal" data-target="#modelId">upload new users</a>
                <a class="btn btn-pink rounded btn-sm mx-3"  @click="download_stock_list()">Download list</a>
            </div>
        </div>
        <div class="tableFixHead" style="height: 500px;">
            <table class="table table-striped table-inverse table-responsive" >
                <thead class="thead-inverse  ">
                    <tr class="bg-purple text-light">
                    <th>#</th>
                    <th>Parent's Name</th>
                    <th>Child's Name</th>
                    <th>Cell number</th>
                    <th>Email Address</th> 
                    <th>Reciept Number</th>
                    <th>Store Name</th>
                     <th>Photo</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody> 
                          <tr v-for="user,i in users">
                            <td scope="row">@{{i+1}}</td>
                            <td>@{{user.parent_name}} @{{user.parent_surname}}</td>
                            <td>@{{user.child_name}} @{{user.child_surname}}</td>
                            <td>@{{user.cell_number}}</td>
                            <td>@{{user.email}}</td>
                            <td>@{{user.reciept}}</td>
                            <td>@{{user.store}}</td>
                            {{-- <td>@{{user.photo}}</td> --}}
                            <td> </td>
                            <td>@{{user.created_at}}</td>
                         </tr>
                  </tbody>
        </table>     
    </div>    
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('cutie_of_the_year_upload_users')}}" enctype="multipart/form-data" method="POST" class="modal-content">
                @csrf
                <div class="modal-header ">
                    <h5 class="modal-title">Upload new Users</h5>
                        <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body"> 
                <div class="">
                        <div class="form-group py-2">
                            <label for="">User File</label>
                            <input type="file" name="file"  class="form-control" placeholder="Enter barcode"  >
                        </div>
                        <small>please see your excel header format</small> <br>
                        <small class="text-danger">
                            Parent Name	Parent Surname	Child Names	Child Surname	Cell Number	Email Address	Reciept Number	Store Name	Registered At
                        </small>                     
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm rounded btn-purple">upload</button>
                </div>
            </form>
        </div>        
    </div> 
    </main>
    <script> 
    </script>
    <script>

var qrcode = new QRCode("qrcode", {
            text: "http://jindo.dev.naver.com/collie",
            width: 150,
            height: 150,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        function makeCode () {    
            var elText = document.getElementById("text");            
            if (!elText.value) {
                alert("Input a text");
                elText.focus();
                return;
            }
            qrcode.makeCode(elText.value);
        }
        makeCode();
        function text(){
            makeCode();
        }
        // ///////////////////////////////////////////
        const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            users:[],
           };
        },
        async created(){
            let data = @json($data);
            this.users = data;
            // console.log(data) 
        },
        methods: {
            download_stock_list: function(){   // Not yet done            
            let dataDB = this.users;
            let data = [] 
                  for (let i = 0; i < dataDB.length; i++) {
                      let user  = {}
                      user['Parent Name'] = dataDB[i].parent_name 
                      user['Parent Surname'] = dataDB[i].parent_surname
                      user['Child Names'] = dataDB[i].child_name 
                      user['Child Surname'] = dataDB[i].child_surname
                      user['Phone Number'] = dataDB[i].cell_number
                      user['Email Address'] = dataDB[i].email
                      user['Reciept Number'] = dataDB[i].reciept
                      user['Store Name'] = dataDB[i].store
                      user['Photo'] = dataDB[i].photo
                      user['Registered At'] = dataDB[i].created_at                       
                     data.push(user)               
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
                XLSX.utils.book_append_sheet(workbook, worksheet, ' Cutie of the Year');          
                try {
                    XLSX.writeFile(workbook, 'Cutie of the Year.xlsx');
                 } catch (error) {
                 } 
              },
            pricing: function(){
                
            }
        }
     }).mount("#app");         
        </script>
</x-app-layout>
