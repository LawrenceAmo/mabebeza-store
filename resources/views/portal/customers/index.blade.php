<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
         
        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">Customers</p>
                {{-- <a class="btn btn-sm btn-primary rounded"  data-toggle="modal" data-target="#create_supplier">Create New Supplier</a> --}}
            </div>
            <div class=" w-100 overflow-auto">
                <table class="table table-striped table-inverse table-responsive w-100">
                    <thead class="thead-inverse">
                        <tr class="bg-dark text-light font-weight-bold">
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th> 
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                           @foreach ($customers as $customer)
                            <tr>
                                 
                                <td scope="row">{{$i}}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                {{-- <td>{{ $customer->website }}</td> --}}
                                <td>
                                     <a href=""> <i class="fas fa-pencil-alt    "></i> </a> | 
                                    <a href="" class="text-danger"> <i class="fas fa-trash-alt    "></i> </a>
                                 </td>
                            </tr>
                            <?php $i++; ?>
                           @endforeach                           
                        </tbody>
                </table>
                @if (count($customers) == 0)
                    <p class="h5 text-muted text-center"><i>No Data To Display</i></p>
                @endif
            </div>
        </div>
 
 
{{-- ///////////////////////////////////////////////// --}}

<!-- Button trigger modal -->
 
<!-- Modal -->
        <div class="modal fade" id="create_supplier" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action=" {{route('create_supplier')}}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header ">
                        <h5 class="modal-title">Create Main Category</h5>
                            <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <div class="">
                            <div class="form-group py-2">
                                <label for="">Supplier Name</label>
                                <input type="text" name="supplier_name"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Supplier Comapny Name</label>
                                <input type="text" name="company_name"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Supplier Email Address</label>
                                <input type="text" name="email"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Supplier Phone Number</label>
                                <input type="text" name="phone"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Supplier Website Link</label>
                                <input type="text" name="website"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            {{-- <div class="form-group py-2">
                                <label for="">Supplier Any Link</label>
                                <input type="text" name="link"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            --}}
                            {{-- <div class="form-group py-2">
                                <label for="">Street</label>
                                <input type="text" name="street"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">City</label>
                                <input type="text" name="city"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Country</label>
                                <input type="text" name="country"  class="form-control" placeholder="Enter Supplier Name"  >
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input " name="multiple_addresses" id="" value="checkedValue" checked>
                                  Have Multiple addresses
                                </label>
                            </div> --}}
                             
                            <div class="form-group py-2">
                            <label for="">Short Description</label>
                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                            </div> 

                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm rounded btn-primary">create main category</button>
                    </div>
                </form>
            </div>
        </div>
 

    </main>
</x-app-layout>