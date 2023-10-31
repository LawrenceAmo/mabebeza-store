
<x-app-layout>
    <main class="m-0  px-4 py-5   w-100"> 
    <div class="card border rounded p-3 w-100 table-responsive">
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div> 
<p class="font-weight-bold h4 d-flex justify-content-between">
   <span> All Promotions  </span>
   <a  class="btn btn-purple rounded btn-sm" data-toggle="modal" data-target="#create_promotion">create new</a>
</p>
  <table class="table table-striped w-auto p-0 " >
    <thead class=" m-0 p-0">
        <tr class="border font-weight-bold shadow bg-dark text-light rounded"  >
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead> 
        <tbody>
             @foreach ($promotions as $promotion)
             <tr>
                 <td scope="row"> </td>
                <td>{{ $promotion->promotion_name}}</td>
                <td>{{$promotion->status ? "Active" : "InActive"}}</td> 
                <td>{{$promotion->start_date}} {{$promotion->start_time}}</td> 
                <td>{{$promotion->end_date}} {{$promotion->end_time}}</td> 
                <td>{{$promotion->created_at}}</td> 
                 <td> <a href="{{ route('promotion_edit', [$promotion->promotionID])}}"> <i class="fa fa-pencil-alt" ></i> </a> </td>                 
             </tr>
             @endforeach                      
        </tbody>
    </table>
    </div>
    <hr>
 
  <!-- Modal -->
  <div class="modal fade" id="create_promotion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <form action="{{ route('promotion_create') }}" method="POST" class="modal-dialog" role="document">
        <div class="modal-content px-2">
            @csrf
            <div class="modal-header ">
                <h5 class="modal-title">Create New Promotion</h5>
                    <button type="button" class="close border-0 bg-white rounded text-danger " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body ">
            <div class=" row ">
                   <div class="col-md-12  ">
                        <div class="form-group">
                        <label for="">Promotion Name</label>
                        <input type="text"
                            class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>  
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm rounded btn-purple" >Create</button>    
                    </div>                                        
            </div>
            </div>

        </div>
    </form>

    </div>
    </main>
    <script> 
    </script>
</x-app-layout>
