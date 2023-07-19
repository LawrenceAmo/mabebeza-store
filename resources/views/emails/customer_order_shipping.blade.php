 

    {{-- 
 
Order information
Order number:
000000000000
Total Amount: R500.00
Shipping Method:
STANDARD SHIPPING
Shipping address:
4165 Cameroun street
Tswelopele TEMBISA 1632
Payment Date:
23 June 2023 10h:00
Estimated shipping time:
23 June 2023 – 25 June 2023 
Order summary
Pampers Dry pants size SIZE: 3 QTY: 1
Subtotal: R180 --}}
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Mabebeza Baby Store</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            /* background-color: #94d2ec; */
        }
        .mail-conatiner{
            /* background-color: #ebe7e8; */
            border: 1px solid #642c94;
            border-radius: 10px;
            padding: 20px;
        }
        a{
            color: #1b1b1b;
            
        }
        .p-3{
            padding: 10px;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .border {
        border: 1px solid #dee2e6 !important;
        }
        .border-bottom {
        border-bottom: 1px solid #dee2e6 !important;
        }
    </style>
     
</head>
<body>
    <div class="mail-conatiner">
        <p class="">Dear <b class="font-weight-bold">{{$order->user_name}} {{$order->user_surname}}</b>,</p>
        <p>Thank you for choosing Mabebeza Baby Store! <br>
             We appreciate your recent order and hope you had a great shopping experience with us.</p>
             <b class="">Your order has been shipped, please stay close to your phone.</b>
        <div class="">
            <center><h3 class="">Order Number: <u class="">{{$order->order_number}}</u></h3></center>
        </div>
        

        <br> <hr>
        <div class="">
            <h3 class="">Items Ordered</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($order->items) as $item)
                    <tr class="border-bottom p-3">
                        <td class="p-3" scope="row">{{$loop->index + 1}}</td>
                        <td class="p-3  " style="width: 60%; ">{{ $item->product_name}}</td>
                        <td class="p-3">R{{ $item->sale_price ?? $item->price }}</td>
                        <td class="p-3">{{ $item->qty}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div class=""> <br>
                <small>All prices are inclusive of VAT at 15% except for ZERO rated goods</small>
            </div>
        </div>
 <br> <hr>
        <div class="">
            <h3 class="">Delivery Address</h3>
            <p>
                <span class="">{{$order->street }} {{$order->suburb }}  </span> <br>
                <span class="">{{$order->city }} {{$order->state }}</span> <br>
                <span class="">{{$order->country }} {{$order->postal_code }}</span>
            </p>
        </div>
        <hr>
        <div class="">
            <b><h3 class="">Order Summary</h3></b>

            <div class="row" >
                <div class="col-6"></div>
                <div class="col-6">
                    <div class=" ">
                    </div>
                    <div class="row   py-2 h6 ">
                        <div class="col-6 ">Sub-Total</div>
                        <div class="col-6 ">&nbsp;R{{ $order->sub_total }}</div>
                    </div>
                    <div class="row w-100 py-2 h6 ">
                        <div class="col-6 ">Shipping Fee</div>
                        <div class="col-6 ">&nbsp;R{{ $order->shipping_amount }}</div>
                    </div>
                    <div class="row w-100 py-2 h6 ">
                        <div class="col-6 ">Dsicounts</div>
                        <div class="col-6 ">-R{{ $order->discount_amount }}</div>
                    </div>
                    <b class="row w-100 py-2 h6 ">
                        <div class="col-6 "> Total Amount</div>
                        <div class="col-6 ">&nbsp;R{{ $order->total_amount }}</div>
                    </b>
                </div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <h3 class="">Our Contact Details</h3>
            <div class="">
                <div class="row  " >
                    <div class="col-6  " style="padding-left: 3%;">
                        
                        <div class="row   py-2 h6 ">
                            <div class="col-6 ">Careline</div>
                            <div class="col-6 "><a href="tel:+s7824723283">+27 61 589 5114</a></div>
                        </div>
                        <div class="row w-100 py-2 h6 ">
                            <div class="col-6 ">WhatsApp</div>
                            <div class="col-6 ">+27 61 589 5114</div>
                        </div>
                        <div class="row w-100 py-2 h6 ">
                            <div class="col-6 ">Email</div>
                            <div class="col-6 ">
                                <a href="mailto:careline@mabebeza.com">careline@mabebeza.com</a>
                            </div>
                        </div>
                        <div class="row w-100 py-2 h6 ">
                            <div class="col-6 ">Website</div>
                            <div class="col-6 "><a href="https://www.mabebeza.com">www.mabebeza.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="">

            <p>
                If you have any questions or need further assistance,
                please feel free to contact us at <a class="" href="mailto:careline@mabebeza.com">careline@mabebeza.com</a>. <br>
                Should your goods be damaged or incorrect on delivery please return them with our driver and we will resolve within 24hours. 
            </p>

            <p class="">
                Thank you once again for choosing Mabebeza Baby Store. <br>
                We look forward to serving you again in the future.
            </p>
            <p class="">

            </p>
 
            </p>  
        <p>Best regards,</p>
        <p>The Mabebeza Team</p> <br>
        <div class="p-3 ">
        <center>Copyright © 2023 Mabebeza Baby Store (Pty) Ltd. All rights reserved</center>
        </div>
    </div>    
</body>
</html>
