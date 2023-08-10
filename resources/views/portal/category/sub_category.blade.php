<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>

         <form action=" {{route('save_sub_category')}}" method="POST" class="card rounded p-3" enctype="multipart/form-data">
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
        <div class=" p-5 text-center">
            <button type="submit" class="btn w-100 btn-purple">Update Sub Category</button>
        </div>
         </form>

    </main>
</x-app-layout>