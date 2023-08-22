@extends('layouts.app')

@section('content')
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script> --}}
{{-- <link rel="stylesheet" href="{{asset('/css/index.css')}}"> --}}
 
<style>
    #qrcode canvas{
        height: 200 !important;
    }
</style>
{{ session('status')}}
<div class="container pb-5 mb-5">
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">{{ __('Survey Data') }}
                    <form class="" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-blue rounded m-0">Home</button>
                    </form> 
                </div>

                <div class="card-body">                    
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr class="bg-dark rounded text-light font-weight-bold">
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
        </div>
    </div>
</div>
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
@endsection
