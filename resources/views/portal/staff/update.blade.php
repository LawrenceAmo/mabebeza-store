<x-app-layout>
<div class="  m-0  shadow rounded p-3  w-100" id="app">
<div class="">
    <p class=" h5 font-weight-bold">Update Staff</p>
    <hr>
    <div class="">
         {{ $staff->first_name}} &nbsp;  {{ $staff->first_name }}
    </div>
    <div class=" row">

        <div class="col-6">
            <div class="form-group">
                <label for="">Where does this user belong to?</label>
                <select class="form-control" name="" id="">
                  <option selected disabled> Select Store </option>
                  @foreach ($stores as $store)
                    <option class="{{ $store->storeID }}">{{ $store->name }}</option>
                  @endforeach
                </select>
              </div>
        </div>

        <div class="col-6">
            <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                  Is this a driver?
                </label>
              </div>
        </div>
 
    </div>
    <div class="">
        <div class="">
            <button>Update</button>
        </div>
    </div>
</div>
</div>
</x-app-layout>

