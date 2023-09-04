<x-guest-layout>
    <style>
    #map {
           height: 400px;
        }
         
    </style>
    <div class="container  bg-white my-5 p-5">
      
        <div class="row">
            <div class=" col-md-8 col-sm-12 ">
            <div class="">
              <p class="h5 text-purple">Please enter delivery address</p>
                <input type="text" class="form-control w-100 form-control-sm rounded location-active location-input" placeholder="Enter Address"  id="location-input" >
            </div> 
                             
            </div>
            <div class=" col-md-4 col-sm-12 pl-md-5">
                <div   class=" shadow rounded p-3">
                  <p class="h5 text-center text-purple">Contact us</p>

                  <div class="row  ">
                    <div class="col-2"><i class="fas fa-phone-volume    "></i></div>
                    <div class="col-10"><a href="tel:+27615895114"> +27 61	589 5114</a></div>
                  </div>
                  <div class="row  ">
                    <div class="col-2"><i class="fas fa-envelope    "></i></div>
                    <div class="col-10"><a href="mailto:careline@mabebeza.com"> careline@mabebeza.com</a></div>
                  </div>
                  <div class="row  ">
                    <div class="col-2"><i class="fab fa-facebook"></i></div>
                    <div class="col-10"><a href="https://www.facebook.com/mabebezababy"> MabebezaBaby</a></div>
                  </div>

                  <div class="row  ">
                    <div class="col-2"><i class="fab fa-instagram"></i></div>
                    <div class="col-10"><a href="https://instagram.com/mabebezababy?igshid=YmMyMTA2M2Y="> MabebezaBaby</a></div>
                  </div>
                  <hr>
                  <div class="">
                    <p class=" h5 text-purple">Important Links</p>
                     <p class=" p-0 m-0"><a href="{{ route('where_we_deliver')}}" class="">Locations where we deliver</a></p>
                     <p class=" p-0 m-0"><a href="{{ route('store-locator')}}" class="">Where we are located</a></p>
                     <p class=" p-0 m-0"><a href="{{ route('delivery-policy')}}" class="">Our Delivery Policy</a></p>
                    </div>
                 </div>
            </div>
        </div>
        {{--  --}}
 
    </div> 
    
    <script>
        const { createApp } = Vue;
    </script>
     <script>
 
      </script>
</x-guest-layout> 
