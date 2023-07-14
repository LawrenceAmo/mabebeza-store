<x-app-layout>
    <main class="m-0 shadow rounded p-3 px-4 w-100">
    
    <div class="row">
        <div class="col-md-12 p-1 ">
            <div class="shadow bg-white rounded p-2  ">
                <p class="font-weight-bold h4">
                    Recent Orders
                </p>
                <div class=" w-100 overflow-auto rounded">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr class="bg-purple text-light">
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Items Qty</th>
                                <th>Total Amount</th>
                                <th>Paid</th>
                                <th>Approved</th>
                                <th>Status</th>
                                <th>Shipphing Store </th>
                                <th>Shipphing To </th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                {{-- && $order->paid == true --}}
                                 @if ( ($order->status == 'pending' || $order->status == 'processing') )
                                <tr>
                                    <td scope="row"></td>
                                    <td>{{$order->order_number}}</td>
                                    {{-- total_amount --}}
                                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                                    <td>{{$order->qty}}</td>
                                    <td>{{$order->total_amount}}</td>
                                    <td> 
                                        @if ($order->paid)
                                           <span class="text-success"> Yes</span>
                                        @else
                                        <span class="text-danger"> No</span>
                                        @endif
                                    </td>
                                    <td> 
                                        @if ($order->paid_all)
                                           <span class="text-success"> Yes</span>
                                        @else
                                        <span class="text-danger"> No</span>
                                        @endif
                                    </td>
                                    <td> 
                                       {{$order->status}}
                                    </td>
                                    <td> <a target="_blank" href="https://www.google.com/maps/place/cameroun+St,+Tswelopele,+Tembisa,+1666/@-25.9638082,28.208273,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9569341a096b43:0x139e8577727bc31d!8m2!3d-25.9638082!4d28.2108479!16s%2Fg%2F1pxqddty2?entry=ttu">
                                        {{$order->store}}</a>
                                    </td>
                                    <td> <a target="_blank" href="https://www.google.com/maps/place/cameroun+St,+Tswelopele,+Tembisa,+1666/@-25.9638082,28.208273,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9569341a096b43:0x139e8577727bc31d!8m2!3d-25.9638082!4d28.2108479!16s%2Fg%2F1pxqddty2?entry=ttu">
                                        {{$order->suburb}}</a>
                                    </td>
                                    <td>{{$order->created_at}}</td>
                                    <td><a href="/portal/orders/{{ $order->orderID }}" class="text-info"><i class="fa fa-eye    "></i></a> </td> 
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                    </table>
                    @if ( !($order->status == 'pending' || $order->status == 'processing') )
                        <div class="text-center ">
                            <p class="h5 font-weight-bold  font-Raleway ">No New Orders</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- Not yet done, I have to config what should I put here... --}}
        
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 p-1 ">
            <div class="shadow bg-white rounded p-2  ">
                <p class="font-weight-bold h4">
                    History / Completed Orders
                </p>
                <div class=" w-100 overflow-auto rounded">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr class="bg-purple text-light">
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Items Qty</th>
                                <th>Total Amount</th>
                                <th>Paid</th>
                                <th>Approved</th>
                                <th>Status</th>
                                {{-- <th>Shipphing Store </th> --}}
                                <th>Shipphing To </th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                @if (($order->status == 'completed' || $order->status == 'cancelled')  )
                                     <tr >
                                        <td scope="row"></td>
                                        <td>{{$order->order_number}}</td>
                                        {{-- total_amount --}}
                                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                                        <td>{{$order->qty}}</td>
                                        <td>{{$order->total_amount}}</td>
                                        <td> 
                                            @if ($order->paid)
                                               <span class="text-success"> Yes</span>
                                            @else
                                            <span class="text-danger"> No</span>
                                            @endif
                                        </td>
                                        <td> 
                                            @if ($order->paid_all)
                                               <span class="text-success"> Yes</span>
                                            @else
                                            <span class="text-danger"> No</span>
                                            @endif
                                        </td>
                                        <td> 
                                           {{$order->status}}
                                        </td>
                                        <td> <a target="_blank" href="https://www.google.com/maps/place/cameroun+St,+Tswelopele,+Tembisa,+1666/@-25.9638082,28.208273,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9569341a096b43:0x139e8577727bc31d!8m2!3d-25.9638082!4d28.2108479!16s%2Fg%2F1pxqddty2?entry=ttu">
                                            {{$order->suburb}}</a></td>
                                        <td>{{$order->created_at}}</td>
                                        <td><a href="/portal/orders/{{ $order->orderID }} class="text-info"><i class="fa fa-eye    "></i></a> </td> 
                                    </tr>
                                 @endif
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Not yet done, I have to config what should I put here... --}}
        
    </div>
    </main>
</x-app-layout>
