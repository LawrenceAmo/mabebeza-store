 <x-app-layout>

<main class="m-0  px-4 w-100">

    <div class="card border rounded p-5  ">
         <div class="row mx-0 animated fadeInDown">
        <div class="col-12   p-0 m-0">
            <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
        </div>
     </div> 

       <form class="" action="{{ route("save_store")}}" method="POST">
         @csrf
      <div class="row">   
          <div class="col-md-6 pt-3">
            <div class=" ">
                <label for="" class="  ">Store Name</label>
                <input type="text" class="form-control " name="store_name"    placeholder="Store Name">
            </div>
          </div>

            <div class="col-md-6 pt-3">
            <div class=" ">
                <label for="" class="  ">Trading or Short Name</label>
                <input type="text" class="form-control " name="trading_name" id=""   placeholder="Trading or Short Store Name">
            </div>
          </div>
      </div>

          <div class="row pt-md-4">   
            <div class="col-md-6 pt-3">
                <div class=" ">
                    <label for="" class="  ">Store Slogan</label>
                <textarea name="slogan" class="form-control" id="" cols="2" rows="2"></textarea>
            </div>
          </div>

            <div class="col-md-6 pt-3">
            <div class=" ">
                <label for="" class="  ">Store Description</label>
                 
                  <textarea class="form-control" name="description" id=""    rows="2"></textarea>
             </div>
          </div>
      </div>
      <div class="row mt-3 pt-3">
       <label class="custom-control custom-checkbox ">
         <input type="checkbox" name="terms_and_conditions" value="true" class="custom-control-input">
         <span class="custom-control-indicator small">By creating a store you agree to our Terms & Conditions</span>
        </label>
      </div>

      <div class="row-cols-12 mt-3 py-3  ">
        <button type="submit" class="btn btn-info w-100">Create Your Store</button>
      </div>

       </form>
    </div>


</main>

 </x-app-layout>
