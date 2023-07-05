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
                <a class="btn btn-sm btn-purple rounded"  data-toggle="modal" data-target="#create_supplier">Create New Staff Member</a>
            </div>
            <div class=" w-100 overflow-auto">
                <table class="table table-striped table-inverse table-responsive w-100">
                    <thead class="thead-inverse">
                        <tr class="bg-purple text-light font-weight-bold">
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th> 
                            {{-- <th>Driver</th>  --}}
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
                                {{-- <td>@if ($user->driver)
                                    Yes
                                @else
                                    No
                                @endif</td> --}}
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
                            <div class="form-group py-2">
                                <label for="">Staff Password</label>
                                <input type="text" name="password"  class="form-control" placeholder="Enter a temporary password"  >
                                <small class="text-muted"><i>All passwords are encrypted using industry-standard encryption algorithms to ensure the highest level of security.</i></small>
                            </div>

                            <div class="form-group">
                              <label for="">Belong to which Store?</label>
                              <select class="form-control" name="store" id="">
                                <option selected disabled>Select Store</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->storeID}}">{{ $store->name}} </option>
                                @endforeach
                                <option value="">All Stores </option>
                               </select>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="driver" id="" value="">
                                  Driver?
                                </label>
                            </div>  
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm rounded btn-purple">create New Staff member</button>
                    </div>
                </form>
            </div>
        </div>
 

    </main>
</x-app-layout>