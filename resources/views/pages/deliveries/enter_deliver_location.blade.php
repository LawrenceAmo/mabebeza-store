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
              <p class="h5">Enter address where to deliver</p>
                <input type="text" class="form-control w-100 form-control-sm rounded location-active location-input" placeholder="Enter Address"  id="location-input" >
            </div> 
            <div class=" py-5  ">
              <p class="h5">Our delivery times</p>

              <table class="table table-striped table-border table-inverse  ">
                <thead class="thead-inverse">
                  <tr class="font-weight-bold bg-purple">
                    <th  class="font-weight-bold">#</th>
                    <th  class="font-weight-bold">Day</th>
                    <th  class="font-weight-bold">Period</th>
                   </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="row">1</td>
                      <td>Mon - Fri</td>
                      <td>12 - 24 hours</td>
                    </tr>
                    <tr>
                      <td scope="row">2</td>
                      <td>Sat - Sun </td>
                      <td>Next Monday</td>
                    </tr>
                    <tr>
                      <td scope="row">3</td>
                      <td>Public Holidays</td>
                      <td>Next working day</td>
                    </tr>
                  </tbody>
              </table>
            </div>                 
            </div>
            <div class=" col-md-4 col-sm-12 pl-5">
                <div   class=" shadow rounded p-3">
                  <p class="h5 text-center">Contact us</p>

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
                    <p class="">Please note that our delivery fee is R35</p>
                    <p class=" p-0"><a href="{{ route('where_we_deliver')}}" class="">Locations where we deliver</a></p>
                    <p class=" p-0"><a href="{{ route('store-locator')}}" class="">Where we are located</a></p>
                  </div>
                 </div>
            </div>
        </div>
        {{--  --}}
 
    </div> 
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7uUbl0Ol0kXBam07UPsjThrxL18qoVzA&callback=initMap&v=weekly"
    defer
  ></script>
    <script>
        const { createApp } = Vue;
    </script>
     <script>
 
      </script>
</x-guest-layout> 
