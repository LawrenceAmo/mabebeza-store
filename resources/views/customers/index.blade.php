<x-customer-layout>

    <div class=" ">
       
        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">My Orders</p>
                {{-- <a class="btn btn-sm btn-primary rounded"  data-toggle="modal" data-target="#create_supplier">Create New Supplier</a> --}}
            </div>
            <div class=" w-100 overflow-auto rounded">
                <table class="table w-100 rounded table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="bg-dark text-light">
                            <th>#</th>
                            <th>Order Number</th>
                             <th>Items Qty</th>
                            <th>Total Price</th>
                            <th>Paid</th>
                            <th>Approved</th>
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
                                <td> {{$order->status}}</td>
                                 <td> <a target="_blank" href=" ">
                                    {{$order->suburb}}</a></td>
                                <td>{{$order->created_at}}</td>
                                <td> <a href="{{ route('guest_order', [$order->orderID]) }}" class=""><i class="fas fa-eye  text-info  "></i></a> </td>
                                  
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