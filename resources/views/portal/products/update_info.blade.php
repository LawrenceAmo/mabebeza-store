<x-app-layout>
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    {{-- <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script> --}}

    <div class="mx-0 mb-5  shadow rounded p-3  w-100" id="app">
        <div class="card border rounded w-100">
            <div class="d-flex justify-content-between  p-2">
                 <div class=""><a class="text-dark btn btn-outline-grey btn-sm rounded" href="{{route('product_update_info', [$product->product_productID])}}">Info</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_price', [$product->product_productID])}}">pricing</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_vendor', [$product->product_productID])}}">Category</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_shipping', [$product->product_productID])}}">Shipping</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded" href="{{route('product_update_media', [$product->product_productID])}}">Media</a></div>
                 <div class=""><a class="text-dark btn btn-sm rounded " href="{{route('product_update_publish', [$product->product_productID])}}">Publish</a></div>
                </div>
         </div>
         <hr>
     <form class=" " action="{{ route('product_save_info', [$product->product_productID])}}" method="POST" >
        @csrf
        <div class="card border rounded p-3 w-100">
        <div class="d-flex justify-content-center "><p class="font-weight-bold h5">Product Information</p></div>
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div>
        <div class=" row">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product SKU/CODE <x-required></x-required></label>
                    <input type="text" class="form-control" name="code" value="{{ $product->sku }}" required placeholder="">
                    </div> 
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Name <x-required></x-required></label>
                    <input type="text" class="form-control" name="name" value="{{ $product->product_name }}" required placeholder="">
                    </div> 
            </div>
        </div>

        <div class=" row py-3">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Meta Title <x-required></x-required></label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}"   placeholder="">
                    </div> 
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Slug <x-required></x-required></label>
                    <input type="text" class="form-control" name="slug" value="{{ $product->slug }}"   placeholder="">
                    </div> 
            </div>
        </div>
  
        <div class=" row py-3">
            <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Short Description</label>
                    <textarea class="form-control" name="description" id="description"  rows="3">{!!$product->description!!}</textarea>
                 </div>
            </div>
             <div class="col-md-6 p-2">
                 <div class="form-group">
                    <label for="">Product Detailed information</label>
                    <textarea class="form-control" name="product_detail" placeholder="optional" id="product_detail" rows="3">{!! $product->product_detail !!}</textarea>
                    </div>
            </div>
        </div>
        <hr>
        
        <div class=" ">
            <button class="btn btn-sm rounded font-weight-bold w-100 btn-purple"> Save Product Info </button>
        </div>
    </div>
    <input type="hidden" class="form-control" name="productID" value="{{ $product->product_productID }}" required placeholder="">

</form>
     </div>
     <script>
        ClassicEditor.create( document.querySelector( '#description' ) )
		.catch( error => {
			console.error( error );
		} );
        ClassicEditor.create( document.querySelector( '#product_detail' ) )
		.catch( error => {
			console.error( error );
		} );
     </script>
 
</x-app-layout>
