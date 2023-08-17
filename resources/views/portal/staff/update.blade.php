<x-app-layout>
<div class="  m-0  shadow rounded p-3  w-100" id="app">
  <div class="row mx-0 animated fadeInDown">
    <div class="col-12 text-center p-0 m-0">
        <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
    </div>
 </div>
<form action="{{ route('update_staff_to_driver')}}" method="POST" class="">
  @csrf
    <p class=" h5 font-weight-bold">Update Staff</p>
    <hr>
    <div class="">
         {{ $staff->first_name}} &nbsp;  {{ $staff->first_name }}
    </div>
    <div class=" row">

        <div class="col-6">
            <div class="form-group">
                <label for="">Where does this user belong to?</label>
                <select class="form-control" name="store" id="">
                  <option selected disabled> Select Store </option>
                  @foreach ($stores as $store)
                    <option class=" " value="{{ $store->storeID }}">{{ $store->name }}</option>
                  @endforeach
                </select>
              </div>
        </div>

        <div class="col-6">
            <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="driver" id="" value="checkedValue" checked>
                  Is this a driver?
                </label>
              </div>
        </div>
 
    </div>
    <input type="hidden" name="userID" value="{{ $staff->id }}">
    <div class="">
        <div class="">
            <button type="submit" class="btn btn-sm rounded btn-purple">Update</button>
        </div>
    </div>
</form>
</div>
</x-app-layout>

