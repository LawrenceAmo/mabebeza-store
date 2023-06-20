<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
         
        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">All Staff</p>
                <a class="btn btn-sm btn-info rounded"  data-toggle="modal" data-target="#create_supplier">Create New Staff Member</a>
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
                           @foreach ($users as $user)
                            <tr>
                                 
                                <td scope="row">{{$i}}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                {{-- <td>{{ $user->website }}</td> --}}
                                <td>
                                     <a href=""> <i class="fas fa-pencil-alt    "></i> </a> | 
                                    <a href="" class="text-danger"> <i class="fas fa-trash-alt    "></i> </a>
                                 </td>
                            </tr>
                            <?php $i++; ?>
                           @endforeach                           
                        </tbody>
                </table>
                @if (count($users) == 0)
                    <p class="h5 text-muted text-center"><i>No Data To Display</i></p>
                @endif
            </div>
        </div>
 
 
{{-- ///////////////////////////////////////////////// --}}

<!-- Button trigger modal -->
 
<!-- Modal -->
        <div class="modal fade" id="create_supplier" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action=" {{route('create_new_staff')}}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header ">
                        <h5 class="modal-title">Create New Staff Member</h5>
                            <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <div class="">
                            <div class="form-group py-2">
                                <label for="">First Name</label>
                                <input type="text" name="first_name"  class="form-control" placeholder="Enter First Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name"  class="form-control" placeholder="Enter Last Name"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Email Address</label>
                                <input type="text" name="email"  class="form-control" placeholder="Enter Email Address"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone"  class="form-control" placeholder="Enter Phone Number"  >
                            </div>
                            
                              {{-- <div class="form-group py-2">
                                <label for="">Street</label>
                                <input type="text" name="street"  class="form-control" placeholder="Enter Street"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">City</label>
                                <input type="text" name="city"  class="form-control" placeholder="Enter City"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">suburb</label>
                                <input type="text" name="suburb"  class="form-control" placeholder="Enter suburb"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">State</label>
                                <input type="text" name="state"  class="form-control" placeholder="Enter City"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Country</label>
                                <input type="text" name="country"  class="form-control" placeholder="Enter Country"  >
                            </div>
                            <div class="form-group py-2">
                                <label for="">Costal Code</label>
                                <input type="text" name="postal_code"  class="form-control" placeholder="Enter postal code"  >
                            </div>
                             --}}
                            <hr>
                            <div class="form-group py-2">
                                <label for="">Staff Password</label>
                                <input type="text" name="password"  class="form-control" placeholder="Enter a temporary password"  >
                                <small class="text-muted"><i> All password are encrypted, once you forget it, you'll have to create a new one.</i></small>
                            </div>
                            
                            
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm rounded btn-info">create New Staff member</button>
                    </div>
                </form>
            </div>
        </div>
 

    </main>
</x-app-layout>