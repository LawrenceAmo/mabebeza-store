<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
         
        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">Main Categories</p>
                <a class="btn btn-sm btn-purple rounded"  data-toggle="modal" data-target="#create_category">Create New main category</a>
            </div>
            <div class="">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="bg-purple">
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                           @foreach ($categories as $category)
                            <tr>
                                <td scope="row">{{$i}}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_short_descript }}</td>
                                 <td>
                                     <a href="{{ route('update_main_category', [$category->categoryID]) }}"> <i class="fas fa-pencil-alt    "></i> </a> | 
                                    {{-- <a href="" class="text-danger"> <i class="fas fa-trash-alt    "></i> </a> --}}
                                 </td>
                            </tr>
                            <?php $i++; ?>
                           @endforeach                           
                        </tbody>
                </table>
                @if (count($categories) == 0)
                    <p class="h5 text-muted text-center"><i>No Data To Display</i></p>
                @endif
            </div>
        </div>

       <div class="py-3">
            <hr class=" ">
       </div>

        <div class="card p-3">
            
            <div class="d-flex justify-content-between border-bottom pb-3">
                <p class="h5">Sub Categories</p>
                <a class="btn btn-sm btn-purple rounded"  data-toggle="modal" data-target="#create_sub_category">Create New sub category</a>
            </div>
            <div class="">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr class="bg-purple">
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Belongs To</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>  <?php $i=1; ?>
                            @foreach ($sub_categories as $sub_category)
                            <tr>
                                <td scope="row">{{$i}}</td>
                                <td>{{ $sub_category->sub_category_name }}</td>
                                <td>{{ $sub_category->sub_category_short_descript }}</td>
                                <td>{{ $sub_category->category_name }}</td>
                                <td>
                                     <a href=""> <i class="fas fa-pencil-alt    "></i> </a> | 
                                    <a href="" class="text-danger"> <i class="fas fa-trash-alt    "></i> </a>
                                 </td>
                            </tr>
                            <?php $i++; ?>

                           @endforeach 
                             
                        </tbody>                        
                </table>
                @if (count($sub_categories) == 0)
                          <p class="h5 text-muted text-center"><i>No Data To Display</i></p>
                        @endif
            </div>
        </div>
{{-- ///////////////////////////////////////////////// --}}

<!-- Button trigger modal -->
 
<!-- Modal -->
        <div class="modal fade" id="create_category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action=" {{route('create_main_category')}}" method="POST" class="modal-content">
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
                            <label for="">Category Name</label>
                            <input type="text" name="name"  class="form-control" placeholder="Enter Category Name"  >
                            </div>
 
                            <div class="form-group py-2">
                            <label for="">Short Description</label>
                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                            </div> 

                    </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm rounded btn-purple">create main category</button>
                    </div>
                </form>
            </div>
        </div>

        {{--  --}}
        <div class="modal fade" id="create_sub_category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('create_sub_category')}}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header ">
                        <h5 class="modal-title">Create Sub Category</h5>
                            <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <div class="">
                            <div class="form-group py-2">
                                <label for="">Category Name</label>
                                <input type="text" name="name"  class="form-control" placeholder="Enter Category Name"  >
                            </div>
                            
                            <div class="form-group py-2">
                                <label for="">Short Description</label>
                                <textarea class="form-control" name="description" id="" rows="3"></textarea>
                            </div> 

                            <div class="form-group py-3">
                                <label for="">Select Main Category</label>
                                <select class="form-control" name="main_category" id="">
                                    <option selected disabled >Select Category </option>                              
                                    @foreach ($categories as $category)
                                        <option value="{{$category->categoryID}}">{{$category->category_name}}</option>                              
                                    @endforeach
                                </select>
                            </div>

                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm rounded btn-purple">create main category</button>
                    </div>
                </form>
            </div>
        </div>
        {{--  --}}

    </main>
</x-app-layout>