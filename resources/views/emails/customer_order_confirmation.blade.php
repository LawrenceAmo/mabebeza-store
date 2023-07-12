 

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
            color: #69C0E4;
        }
        .p-3{
            padding: 10px;
        }
    </style>
     
</head>
<body>
    <div class="mail-conatiner">
        <p class="">Dear <b class="font-weight-bold">{{$order->user_name}} {{$order->user_surname}}</b>,</p>
        <p>Thank you for choosing Mabebeza Baby Store! <br>
             We appreciate your recent order and hope you had a great shopping experience with us.</p>
        <div class="">
            <center><h3 class="">Order Information</h3></center>
        </div>
        <table class="table"> 
            </thead> 
            <tbody>
                <tr>
                     <td>
                        <span class="p-3">Order Number:</span>
                     </td>
                    <td><b class="">{{$order->order_number}}</b></td>
                </tr>
                <tr>
                    <td>
                    <span class="p-3">Items qty Ordered:</span>
                    </td>
                    <td><b class="">{{$order->qty}}</b></td>
                </tr>
                <tr>
                    <td>
                       <span class="p-3">Total Amount:</span>
                    </td>
                   <td><b class="">R <span>{{$order->total_amount}}</span></b></td>
                </tr>
                <tr>
                    <td>
                       <span class="p-3">Estimated Shipping Time:</span>
                    </td>
                   <td><b class=""><span>12 - 24 hr</span></b></td>
                </tr>
                 
            </tbody>
        </table>

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
                    <tr>
                        <td class="p-3" scope="row">1</td>
                        <td class="p-3">{{ $item->product_name}}</td>
                        <td class="p-3">R{{ $item->sale_price ?? $item->price }}</td>
                        <td class="p-3">{{ $item->qty}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
 <br> <hr>
        <div class="">
            <h3 class="">Delivery Address</h3>
            <p>
                <b class="">{{$order->street }} {{$order->suburb }}  </b> <br>
                <b class="">{{$order->city }} {{$order->state }}</b> <br>
                <b class="">{{$order->country }} {{$order->postal_code }}</b>
            </p>
        </div>
        <p class="">

            <p>
                If you have any questions or need further assistance,
                please feel free to contact us at <a class="" href="mailto:careline@mabebeza.com">careline@mabebeza.com</a>. <br>
                Our dedicated team is ready to help you.
            </p>

            <p class="">
                Thank you once again for choosing Mabebeza Baby Store. <br>
                We look forward to serving you again in the future.
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
