 
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
        <p>There's a new order at Mabebeza {{$order->store}}. Visit your admin panel at <a href="https://www.mabebeza.co.za/portal">https://www.mabebeza.co.za/portal</a> to view. <br></p>
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
                       <span class="p-3">Store:</span>
                    </td>
                   <td><b class="">Mabebeza {{$order->store}}</b></td>
               </tr>
                <tr>
                    <td>
                       <span class="p-3">Order Date: </span>
                    </td>
                <td><b class=""><span>                
                        <?php $dateTime = new DateTime($order->created_at);  ?>  
                        </i>
                        {{ $dateTime->format('d F Y H:i:s') }}</span></b>
                 </td>
                </tr>
                <tr>
                    <td>
                    <span class="p-3">Items qty Ordered:</span>
                    </td>
                    <td><b class="">{{$order->qty}}</b></td>
                </tr>
                <tr>
                    <td>
                       <span class="p-3">Sub-Total:</span>
                    </td>
                   <td><b class="">R <span>{{$order->sub_total}}</span></b></td>
                </tr>
                <tr>
                    <td>
                       <span class="p-3">Discount Amount:</span>
                    </td>
                   <td><b class="">-R <span>{{$order->discount_amount}}</span></b></td>
                </tr>
                <tr>
                    <td>
                       <b class="p-3">Total Amount:</b>
                    </td>
                   <td><b class="">R <span>{{$order->total_amount}}</span></b></td>
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
        <div class="row">
            <div class="col-6">
                <h3 class="">Billing  To:</h3>
                <p>
                    <b class="">{{$order->user_surname }} {{$order->user_name }}  </b> <br>
                    <b  class="">{{$order->user_phone }} / {{$order->user_email }}  </b> <br> <br>
                     <b class="">{{$order->user_street }} {{$order->user_suburb }}  </b> <br>
                    <b class="">{{$order->user_city }} {{$order->user_state }}</b> <br>
                    <b class="">{{$order->user_country }} {{$order->user_postal_code }}</b>
                </p>
            </div>
            <div class="col-6">
                <h3 class="">Deliver To:</h3>
                <p>
                    <b class="">{{$order->first_name }} {{$order->last_name }}  </b> <br>
                    <b  class="">{{$order->phone }} / {{$order->email }}  </b> <br> <br>
                     <b class="">{{$order->street }} {{$order->suburb }}  </b> <br>
                    <b class="">{{$order->city }} {{$order->state }}</b> <br>
                    <b class="">{{$order->country }} {{$order->postal_code }}</b>
                </p>
            </div>
        </div>
           
        <p>Best regards,</p>
        <p>The Mabebeza System</p> <br>
        <div class="p-3 ">
        <center>Copyright © 2023 Mabebeza Baby Store (Pty) Ltd. All rights reserved</center>
        </div>
    </div>    
</body>
</html>
