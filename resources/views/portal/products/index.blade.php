<x-app-layout>
    <main class="shadow rounded p-3">
        
    <div class="  row bg-white shadow m-0   rounded p-3 w-100">
         
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">Stock Value <span>R?</span></p>
             </div>
        </div>
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center"> Out of Stock  <span>R?</span></p>
             </div>
        </div>
        {{-- <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">  Earnings <span>R2342</span></p>
             </div>
        </div> --}}
        <div class="col-md-4">
             <div class="card p-3 border border-success">
                <p class="font-weight-bold h5 text-center">Total Products <span>{{count($products)}}</span></p>
             </div>
        </div>

        
    </div>
    <hr>
    <div class="row mx-0 animated fadeInDown">
        <div class="col-12 text-center p-0 m-0">
            <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
        </div>
     </div>
    <div class="card   rounded p-3 w-100">
<p class="font-weight-bold h4 d-flex justify-content-between">
   <span> All Products  </span> <a class="btn btn-primary rounded btn-sm" data-toggle="modal" data-target="#modelId">add new product</a>
</p>
{{-- href="{{ route('create_product')}}" --}}
<?php $i = 1 ?>
<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>Item</th>
            <th>Name</th>
            <th>Cost Price</th>
            <th>Price</th>
            <th>Total Inventory</th>
            <th>Availability</th>
            <th>Published</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>            
            @foreach ($products as $product)
             <tr>
                <td scope="row">{{$i}}</td>
                <td><img src="{{ asset('images/products/img.jpg') }}" alt="" style="height: 60px;"></td>
                <td>{{$product->name}}</td>
                <td>R{{$product->price}}</td>
                <td>R{{$product->cost_price}}</td>
                <td>R{{$product->quantity}}</td> 
                <td>
                    @if ($product->availability)
                        <span class="">Yes</span>
                    @else
                        <span class="">No</span> 
                    @endif
                </td>
                <td>
                    @if ($product->availability)
                        <span class="">Yes</span>
                    @else
                        <span class="">No</span> 
                    @endif
                    </td>
                 <td class=" px-0">
                    <a href="" class="px-1 text-info"><i class="fas fa-eye    "></i></a> |
                    <a href="" class="px-1 text-primary"><i class="fa fa-fas fa-pencil-alt    "></i></a>|
                    <a href="" class="px-1 text-danger"><i class="fas fa-trash-alt    "></i></a>
                </td>
            </tr>
             <?php $i++ ?>
            @endforeach            
        </tbody>
</table>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('create_product')}}" method="POST" class="modal-content">
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
                            <label for="">Product Name</label>
                            <input type="text" name="product_name"  class="form-control" placeholder="Enter Category Name"  >
                        </div>
                                              
                        <div class="form-group py-3">
                            <label for="">Select Sub Category</label>
                            <select class="form-control" name="sub_category" >
                                <option selected disabled >Select Category </option>                              
                                @foreach ($sub_categories as $category)
                                    <option value="{{$category->sub_categoryID}}">{{$category->sub_category_name}}</option>                              
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group py-3">
                            <label for="">Select Supplier</label> 
                            <select class="form-control" name="supplier" id="">
                                <option selected disabled >Select Supplier </option>                              
                                @foreach ($suppliers as $supplier)                            
                                    <option value="{{$supplier->supplierID}}">{{$supplier->supplier_name}} {{$supplier->company_name}}</option>                              
                                @endforeach
                            </select>
                        </div>

                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm rounded btn-primary">create product</button>
                </div>
            </form>
        </div>
    </div>
 
    </main>
</x-app-layout>
