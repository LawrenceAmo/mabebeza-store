
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
   <a  class="btn btn-purple rounded btn-sm" data-toggle="modal" data-target="#create_new_store">create new</a>
</p>
{{-- href="{{ route('create_store')}}" --}}
 <table class="table table-striped w-auto p-0 " >
    <thead class=" m-0 p-0">
        <tr class="border font-weight-bold shadow bg-dark text-light rounded"  >
            <th>#</th>
            <th>Name</th>
            <th>---</th>
            <th>Active</th>
            {{-- <th>Jobs</th> --}}
             <th>Created</th>
             <th>Action</th>
        </tr>
        </thead> 
        <tbody>
             {{-- @foreach ($stores as $store)
             <tr>
                 <td scope="row"> </td>
                <td><a href="{{ route('store', [$store->storeID])}}">{{$store->name}}</a></td>
                <td><a href="{{ route('store', [$store->storeID])}}">{{$store->trading_name}}</a></td> 
                <td>{{$store->active}}</td> 
                <td> </td>
                 <td class="text-center">
                     <a href="{{ route('store', [$store->storeID])}}" title="Click to View Store Data" class="px-1 text-info"><i class="fa fa-fas fa-eye    "></i></a>
                  </td>
             </tr>
             @endforeach --}}
       
                      
        </tbody>
    </table>
    <div class="">
        <p class="text-center h3 font-weight-bold">
            <i>Coming Soon...</i>
        </p>
    </div>
     
    </div>

    <hr>
 

    </main>
    <script> 
    </script>
</x-app-layout>
