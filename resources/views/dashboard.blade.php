<x-app-layout>
    <main class="m-0 px-4 w-100">
        
    <div class="row rounded w-100"> 
        <a class="col-md-3 text-dark" href="{{ route('customers') }}">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Customers </p>
               <b>{{$customers}}</b>
            </div>
        </a> 
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Stock Value </p>
               <b>R{{$total_stock_value}}</b>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Orders </p>
               <b>{{count($orders)}}</b>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">New Orders </p>
               <b>{{$new_orders}}</b>
            </div>
        </div> 
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12 p-1">
            <div class="shadow bg-white rounded p-2  ">
                <p class="font-weight-bold h4">
                    Recent Orders
                </p>
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="bg-dark text-light">
                            <th>#</th>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Items Qty</th>
                            <th>Total Price</th>
                            <th>Shipphing Store </th>
                            <th>Shipphing To </th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td scope="row"></td>
                                <td>{{$order->order_number}}</td>
                                {{-- total_amount --}}
                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                <td>{{$order->qty}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td> </td>
                                <td> <a target="_blank" href="https://www.google.com/maps/place/cameroun+St,+Tswelopele,+Tembisa,+1666/@-25.9638082,28.208273,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9569341a096b43:0x139e8577727bc31d!8m2!3d-25.9638082!4d28.2108479!16s%2Fg%2F1pxqddty2?entry=ttu">
                                    {{$order->suburb}}</a></td>
                                <td>{{$order->created_at}}</td>
                                <td> </td>
                                  
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
        {{-- Not yet done, I have to config what should I put here... --}}
        
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12  p-1">
            <div class="shadow bg-white rounded p-2 overflow-auto">
                <p class="">Open Tickets</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ticket Number</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </main>
</x-app-layout>
