<x-app-layout>
    <main class="shadow rounded p-3">
       
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>

         <form action=" {{route('save_main_category')}}" method="POST" class="card rounded p-3" enctype="multipart/form-data">
            @csrf
            <div class="row">
                 <div class="col-md-6 border-right">
                    <div class="form-group py-2">
                        <label for="">Category Name</label>
                        <input type="text" name="name"  class="form-control" placeholder="Enter Category Name" value="{{ $category->category_name}}" >
                        </div>
                        <div class="form-group py-2">
                            <label for="">Category Image</label>
                            <input type="file" name="image"  class="form-control" placeholder="Enter Category Name"  >
                        </div>
        
                        <div class="form-group py-2">
                        <label for="">Activate Category on Home Page</label>
                        <div class="">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="description" {{ $category->category_descript ? 'checked' : '' }}   class="custom-control-input" >
                                <span class="custom-control-indicator">Activate</span>
                            </label>                           
                        </div>
                         </div>
                 </div>
             
                <div class="col-md-6 border-left">
                    <div class="text-center">
                        <img loading="lazy" height="300" width="300"  class="  main-category-img rounded-circle shadow p-1" style="border:3px solid #94d2ec;" src="{{ asset('storage/images/background/'.$category->category_short_descript)}}" alt="">
                    </div>
                </div>
                <input type="hidden" name="categoryID" value="{{$category->categoryID}}">

        </div>
        <div class=" p-5 text-center">
            <button type="submit" class="btn w-100 btn-purple">Update Category</button>
        </div>
         </form>

    </main>
</x-app-layout>