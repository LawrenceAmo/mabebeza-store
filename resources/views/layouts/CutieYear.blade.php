<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Mabebeza Cutie of the Year</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{asset('/mdb/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/mdb/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('/mdb/css/cutieyear.css')}}">
 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Libre+Franklin:wght@300&family=Raleway:wght@500;900&display=swap" rel="stylesheet">
 
        <style>
            p span {   
            display: block;
            }
            span{
                padding: 0px !important;
                margin: 0px !important;
            }
        </style>
    </head>
    <body class="antialiased body  "> 
        <div class="d-flex justify-content-center pt-3">
            <img src="{{ asset('/images/BlueCircle.svg') }}" class="circle-blue" alt=""> 
            <a class="" href="/"><img src="{{ asset('/logo.png') }}"  style="width: 200px;z-index:10;" class=" m-0 ml-3" alt=""></a>
        </div>
        <main class="py-4">
            {{ $slot }}
        </main>
        <div class="  w-100 p-2 footer" style="">
            <p class="text-white text-center">
                One-stop-shop with GREAT PRICES for baby'sessentials. Shop 32A Tembisa Megamart & Shop 91A Bambanani Mall in Diepsloot.
            </p>
        </div>
 
    </body>
</html>
 
