
<x-app-layout>
    <main class="m-0  px-4 py-5   w-100" id="app">
      
   
    <form action="{{ route('promotion_update') }}" method="POST" class="card border rounded p-3 w-100 table-responsive">
        <div class="row mx-0 animated fadeInDown">
            <div class="col-12 text-center p-0 m-0">
                <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
            </div>
         </div> 
        <div class="font-weight-bold h4 row">
            <div class="col-md-4">
                <span class="font-weight-bold  "> Update: {{ $promotion->promotion_name}}  </span>
            </div>   
         <div class="col-md-8 d-flex justify-content-end">
            <a href="{{ route('promotion_items', [$promotion->promotionID]) }}" class="btn btn-pink rounded btn-sm mx-3">View Products</a>
        <button type="submit"  class="btn btn-purple rounded btn-sm mx-3" >save updates</button>
        </div>
        </div>
        @csrf
        <div class="border-top rounded p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="">Promotion Name</label>
                <input type="text"
                    class="form-control" name="promotion_name" value="{{$promotion->promotion_name}}" id="" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="col-md-6 pt-3 v-center">
                 <label class="custom-control custom-checkbox">
                <input type="checkbox" name="status"  {{$promotion->status ? 'checked' : ''}}  class="custom-control-input"  >
                Promotion Status (Active/InActive)
                </label>
            </div>
        </div>
        <hr>
        
        <div class="row py-3">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Promotion Start Date-Time</label>
                            <input type="date" name="start_date"
                                class="form-control" value="{{$promotion->start_date}}"
                                min="{{now()->toDateString()}}"
                                placeholder="Enter a start date and time (YYYY-MM-DDTHH:MM)">
                            </div>                            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Promotion Start Time</label>
                            <input type="time" name="start_time"
                                class="form-control" value="{{ \Carbon\Carbon::parse($promotion->start_time)->format('H:i')}}"
                                min="{{now()->format('H:i')}}"
                                 >
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Promotion End Date-Time</label>
                            <input type="date" name="end_date"
                                class="form-control" value="{{$promotion->end_date}}"
                                min="{{now()->toDateString()}}"
                                placeholder="Enter a end date and time (YYYY-MM-DDTHH:MM)">
                            </div>                            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Promotion End Time</label>
                            <input type="time" name="end_time"
                                class="form-control" value="{{ \Carbon\Carbon::parse($promotion->end_time)->format('H:i')}}"
                                min="{{now()->format('H:i')}}"
                                 >
                            </div>
                    </div>
                </div>
            </div>     
        </div>
        <div class="row py-3">
            <div class="col-md-6">
                <div class="form-group">
                <label for="">Description (optional)</label>
                <textarea class="form-control" name="description" rows="5">{{$promotion->description}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Comments (optional)</label>
                    <textarea class="form-control" name="comments" rows="5"> {{$promotion->comments}}</textarea>
                </div>
            </div>
        </div>
        </div>
        <input type="hidden" name="promotionID" value="{{$promotion->promotionID}}">
    </form>

    <hr> 
    </main>
    <script>
    
    const { createApp } = Vue;
      createApp({
        data() {
          return {
            vendor_product_price: '',
            promotion: {},
            };
        },
        async created(){
            let promotion =  @json($promotion);
            this.promotion = promotion;
            console.log("amo start pricing")
            console.log(promotion)

            // Get the checkbox element
            let promotionStatus = document.getElementById('promotionStatus');

            // Check the 'promotion.status' and set the 'checked' attribute accordingly
            if (promotion.status) {
                promotionStatus.checked = true;
            } else {
                promotionStatus.checked = false;
            }
        },
        methods: {
            margin_type: function(margin_type_v){ 
            },
          
        }

     }).mount("#app");

    </script>


</x-app-layout>
