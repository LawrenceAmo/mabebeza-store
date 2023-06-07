<x-app-layout>
    <main class="m-0 px-4 w-100">
        
    <div class="row rounded w-100"> 
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Customers </p>
               <b>{{$customers}}</b>
            </div>
        </div> 
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Stock Value </p>
               <b>R{{$total_stock_value}}</b>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" p-3 rounded shadow bg-white   text-center">
               <p class="font-weight-bold h5 ">Total Orders </p>
               <b>{{$total_orders}}</b>
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
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items Qty</th>
                            <th>Total Price</th>
                            <th>Shipphing Store </th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
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
