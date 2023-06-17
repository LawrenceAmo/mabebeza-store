<x-customer-layout>

    <div class=" ">
       
        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">My Orders</p>
                {{-- <a class="btn btn-sm btn-primary rounded"  data-toggle="modal" data-target="#create_supplier">Create New Supplier</a> --}}
            </div>
            <div class=" w-100 overflow-auto">
                <table class="table w-100 table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="bg-dark text-light">
                            <th>#</th>
                            <th>Order Number</th>
                             <th>Items Qty</th>
                            <th>Total Price</th>
                            <th>Order Status</th>
                             <th>Shipphing To </th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{$order->order_number}}</td>
                                {{-- total_amount --}}
                                {{-- <td>{{$order->first_name}} {{$order->last_name}}</td> --}}
                                <td>{{$order->qty}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td> {{$order->status}}</td>
                                 <td> <a target="_blank" href="https://www.google.com/maps/place/cameroun+St,+Tswelopele,+Tembisa,+1666/@-25.9638082,28.208273,17z/data=!3m1!4b1!4m6!3m5!1s0x1e9569341a096b43:0x139e8577727bc31d!8m2!3d-25.9638082!4d28.2108479!16s%2Fg%2F1pxqddty2?entry=ttu">
                                    {{$order->suburb}}</a></td>
                                <td>{{$order->created_at}}</td>
                                <td> <i class="fas fa-eye  text-info  "></i> </td>
                                  
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                @if (count($orders) == 0)
                    <p class="h5 text-muted text-center"><i>You have no Orders</i></p>
                @endif
            </div>
        </div>
    </div>

</x-customer-layout>