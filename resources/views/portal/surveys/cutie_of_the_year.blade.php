<x-app-layout>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
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
    <main class="m-0  px-4 py-5   w-100">
      
   
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
                        <?php $i = 1; ?>
                    @foreach ($data as $user)
                        <tr>
                            <td scope="row">{{$i}}</td>
                            <td>{{$user->parent_name}} {{$user->parent_surname}}</td>
                            <td>{{$user->child_name}} {{$user->child_surname}}</td>
                            <td>{{$user->cell_number}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->reciept}}</td>
                            <td>{{$user->store}}</td>
                            {{-- <td>{{$user->photo}}</td> --}}
                            <td> </td>
                            <td>{{$user->created_at}}</td>
                         </tr>
                        <?php $i++; ?>
                    @endforeach 
                </tbody>
        </table>     
    </div>    
    </div>
 
    </main>
    <script> 
    </script>
    <script>

        // var qrcode = new QRCode(document.getElementById("qrcode-2"), {
        // 	text: "https://webisora.com",
        // 	width: 128,
        // 	height: 128,
        // 	colorDark : "#5868bf",
        // 	colorLight : "#ffffff",
        // 	correctLevel : QRCode.CorrectLevel.H
        // });
        // var qrcode = new QRCode("qrcode");
        
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
         
        </script>
</x-app-layout>
