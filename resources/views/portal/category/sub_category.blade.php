<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>

         <form action="{{route('save_sub_category')}}" method="POST" class="card rounded p-3" enctype="multipart/form-data">
            @csrf
            <div class="row">
                 <div class="col-md-12 border-right">
                    <div class="form-group py-2">
                        <label for="">Sub Category Name</label>
                        <input type="text" name="name"  class="form-control" placeholder="Enter Category Name" value="{{ $category->sub_category_name}}" >
                        </div>
                        
                        <div class="form-group py-2">
                        <label for="">Short Description</label>
                        <textarea class="form-control" name="description" id="" rows="3">{{$category->sub_category_short_descript}}</textarea>
                        </div>
                 </div>
              
                <input type="hidden" name="sub_categoryID" value="{{$category->sub_categoryID}}">

        </div>
        <div class=" d-flex justify-content-around p-5 text-center">
            <button type="button" class="btn w-25 btn-pink" data-toggle="modal" data-target="#modelId">Delete this category</button>
            <button type="submit" class="btn w-25 btn-purple">Update Sub Category</button>
        </div>
         </form>

    </main>
     
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Delete &nbsp; <b class="">{{ $category->sub_category_name}}</b> sub-category</h5>
                                <button type="button" class="close border-0 bg-white text-pink" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        Are you sure you want to delete this category? <br> 
                        <span>Please note that this action is irreversible</span>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> --}}
                    <a href="{{route('delete_sub_category', [$category->sub_categoryID])}}" type="button" class="btn btn-pink">Yes Delete</a>
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
</x-app-layout>