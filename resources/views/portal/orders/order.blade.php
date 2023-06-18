<x-app-layout>
    <main class="m-0 shadow rounded p-3 px-4 w-100">
    
    <div class="row">
        <div class="col-md-12 p-1 ">
            <div class="    ">
                <p class="font-weight-bold h5 border-bottom">
                    Order Number: {{ $order->order_number }}
                </p>
                <div class="row mx-0 animated fadeInDown">
                    <div class="col-12 text-center p-0 m-0">
                        <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
                    </div>
                 </div>
                <div class=" w-100 overflow-auto rounded">
                     <div class="shadow bg-white rounded   p-2">
                        <p class="font-weight-bold pb-0 mb-0">Billing To:</p>
                        <div class="d-flex">
                            <table class="table p-1  table-inverse table-responsive">                                
                                    <tbody>
                                        <tr>
                                             <td>First Name</td>
                                            <td>{{ $order->user_name}} </td>
                                            <td>Street</td>
                                            <td>{{ $order->user_street}} </td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                           <td> {{ $order->user_surname}}</td>
                                           <td>Suburb</td>
                                       <td> {{ $order->user_suburb}}</td>
                                       </tr>
                                        <tr>
                                             <td>Phone</td>
                                            <td> {{ $order->user_phone}}   </td>
                                            
                                         <td>Town/City</td>
                                         <td> {{ $order->user_city}}   </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                           <td>   {{ $order->user_email}} </td>
                                           <td>State</td>
                                       <td>   {{ $order->user_state}} </td>
                                       </tr>
                                       <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Country</td>
                                        <td>   {{ $order->user_country}} </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        <td></td>
                                            <td>Postal Code</td>
                                            <td>   {{ $order->user_postal_code}} </td>
                                        </tr>
                                    </tbody>
                            </table>
                              
                        </div>
                     </div>
                     <hr>
                     <div class="shadow shadow bg-white rounded   p-2">
                        <p class="font-weight-bold pb-0 mb-0">Shipphing To:</p>
                        <div class="">
                            <table class="table   table-inverse table-responsive">                                
                                    <tbody>
                                        <tr>
                                             <td>First Name</td>
                                            <td>{{ $order->first_name}}  </td>
                                            <td>Street Address</td>
                                            <td>{{ $order->street}}  </td>
                                        </tr>
                                        <tr>
                                            <td>last Name</td>
                                           <td> {{ $order->last_name}}</td>
                                           <td>Suburb</td>
                                            <td> {{ $order->suburb}}</td>
                                       </tr>
                                        <tr>
                                             <td>Phone</td>
                                            <td> {{ $order->phone}}  </td>
                                            <td>Town/City</td>
                                            <td> {{ $order->city}}  </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                           <td>   {{ $order->email}} </td>
                                           <td>State</td>
                                            <td>   {{ $order->state}} </td>
                                       </tr>
                                         <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Country</td>
                                            <td>   {{ $order->country}} </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>postal Code</td>
                                            <td>   {{ $order->postal_code}} </td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                     </div>
                     <hr>
                     <div class="shadow shadow bg-white rounded   p-2">
                        <p class="font-weight-bold pb-0 mb-0">Order Info:</p>
                        <div class="">
                            <table class="table   table-inverse table-responsive">
                                <tbody>
                                    <tr>
                                         <td>Order Number</td>
                                        <td>{{ $order->order_number}} </td>
                                        <td>Sub-total Amount</td>
                                        <td>R{{ $order->sub_total}} </td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                       <td> {{ $order->status}}</td>
                                       <td>Discounts</td>
                                   <td> R{{ $order->discount_amount}}</td>
                                   </tr>
                                    <tr>
                                         <td>Approved</td>
                                        <td> @if ($order->paid_all)
                                            <span class="text-success"> Yes</span>
                                         @else
                                         <span class="text-danger"> No</span>
                                         @endif   </td>
                                        
                                         <td>Shipping Fee Paid</td>
                                         <td>R{{ $order->shipping_amount}} </td>
                                    </tr>
                                    <tr>
                                        <td>Paid</td>
                                       <td>   
                                        @if ($order->paid)
                                           <span class="text-success"> Yes</span>
                                        @else
                                        <span class="text-danger"> No</span>
                                        @endif </td>
                                        <td>Total Amount Paid</td>
                                        <td>R{{ $order->total_amount}} </td>
                                   </tr>
                                   <tr>
                                    <td>Items qty</td>
                                    <td>{{ $order->qty}}</td>
                                    <td>Refunds</td>
                                    <td>R{{ $order->total_amount_refunded}} </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Method</td>
                                        <td>{{$order->shipping_method}}</td>
                                        <td>Shipphing Status</td>
                                        <td> {{ $order->status}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                     <hr>
                     <div class="shadow shadow bg-white rounded   p-2">
                        <p class="font-weight-bold pb-0 mb-0">Items Ordered:</p>
                        <div class="">

                            @foreach (json_decode($order->items) as $item)
                            <div class="w-100 border-bottom p-2"  >                     
                                <div  class="shadow  m-0  p-2 row  w-100 rounded">
                                    <div   class="col-md-2"> 
                                        <img height="80" src="{{ asset('storage/products/'.$item->url) }}" alt="">
                                    </div>
                                    <div   class="col-md-5">
                                        <div class="h5">{{$item->product_name}}</div>
                                        <small class=" ">{{$item->sub_category_name}}</small>
                                    </div>
                                    <div   class="col-md-2">
                                        @if ($item->sale_price)
                                        <div class="h6 text-muted"  ><del>R{{$item->price}}</del></div>
                                        <div class="h5"  >R{{$item->sale_price}}</div>

                                        @else
                                        <div class="h5" v-else>R{{$item->price}}</div>  
                                        @endif
                                        {{-- @if ($item->sale_price)
                                        <div class="h5" v-if="product.sale_price">R@{{product.sale_price}}</div>
                                        @endif --}}
                                        
                                    </div>
                                    <div class="col-md-2  ">
                                         <div class="">
                                            <p class="">Ordered Qty</p>
                                            <div class="text-center">{{ $item->qty}}</div>
                                         </div>
                                    </div>
                                    <div class="col-md-1   d-flex flex-column justify-content-center">
    
                                        <a   class="text-danger  zoom">
                                             {{-- <i class="fa fa-times" aria-hidden="true"></i> --}}
                                        </a>
                                    </div>
                                </div>
                             </div>
                            @endforeach

                        </div>
                     </div>
                     <hr>
                     <div class="shadow shadow bg-white rounded   p-3 mb-5">
                        <p class="font-weight-bold pb-0 mb-0">Actions:</p>
                        <div class="row p-0 m-0">
                            <div class="col-md-4">
                                @if (!$order->paid_all)
                                <div class="">Order Not Approved</div>
                                <div class=""><a data-toggle="modal" data-target="#approve_order" class="btn btn-sm rounded btn-info">Approve this order</a></div> 
                                @else
                                <div class="text-success">Order Approved</div>
                                <div class="">
                                    <table class="table">                                         
                                        <tbody>
                                            <tr>
                                                 <td>Approved By</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                 <td>Approved At</td>
                                                <td>{{ $order->approved_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class=""><a class="btn btn-sm rounded btn-info">Approve this order</a></div>  --}}
                                @endif    
                            </div>
                            <div class="col-md-4">
                                {{-- <div class="">Order Not Approved</div><div class=""><a href="" class="btn btn-sm rounded btn-info">Approve this order</a></div> --}}
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
         
    </div>
    <hr>
    {{-- /////////////////////////////  Modal   ///////////////////////////////////// --}}
 
     <!-- Modal -->
     <div class="modal fade" id="approve_order" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Approve Order Number - {{$order->order_number}}</h5>
                                <button type="button" class="close bg-white border-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <p class="">To Approve this order, Please note that:</p>
                            <ul>
                                <li>This <span class="text-danger"> ({{$order->order_number}})</span> Order Number is available on Payfast Transactions</li>
                                <li>Paid must be <span class="text-success">Yes</span> NOT <span class="text-danger">No</span></li>
                                <li>Total amount paid, should be <span class="text-success">R{{$order->total_amount}}</span> Even on PayFast</li>
                                <li class="text-danger">This Action is irevesable</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <form action="{{ route('approve_order')}}" method="post">
                        @csrf
                        <input type="hidden" name="order_number" value="{{ $order->order_number }}">
                        <button type="submit" class="btn btn-info">Approve anyway</button>
                     </form>
                </div>
            </div>
        </div>
     </div>
     
     <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
        });
     </script>
    </main>
</x-app-layout>
