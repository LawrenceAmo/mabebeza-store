<x-guest-layout>
    <style>
    #map {
           height: 400px;
        }
    </style>
    <div class="container my-5 p-5">
      
        <div class="row">
            <div class=" col-md-4 col-sm-12 ">
            <div class="">
                <p class="h5 font-Raleway">Locations</p>
                <ol>
                    <li class="font-weight-bold text-purple">Tembisa</li>
                    <li>Midrand</li>                    
                    <li>Olifantsfontein</li>
                    <li>Clayville</li>
                    <li>Noordwyk</li>
                    <li>Randjespark</li>
                    <li class="font-weight-bold text-purple">Diepsloot</li>
                    <li>Olievenhoutbosch</li>
                    <li>Fourways</li>
                    <li>Sunninghill</li>
                    <li>Waterfall city</li>
                    <li>Farmall</li>                    
                </ol>
            </div>                  
            </div>
            <div class=" col-md-8 col-sm-12 ">
                <div   class="">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        {{--  --}}


       <div class="bg-white text-dark rounded shadow p-3 mt-5">
        <div class="  h3 text-purple text-center"><p class=" ">Contact Us</p></div>
        <div class="row  border-bottom pb-3">
          <div class="col-4">
               <div class=""> 
                   <a href="tel:+27615895114" class="text-dark"> <i class="fa fa-phone    "></i> &nbsp;  +27 61 589 5114</a> <br>
                </div>
          </div>
          <div class="col-4">
            <div class=""> 
                <a href="mailto:info@mabebeza.com" class="text-dark"><i class="fa fa-envelope"  ></i> &nbsp; info@mabebeza.com</a> <br>
                <a href="mailto:careline@mabebeza.com" class="text-dark"><i class="fa fa-envelope"  ></i> &nbsp; careline@mabebeza.com</a>
             </div>
           </div>
           <div class="col-4">
            <div class=""> 
                <a href="https://instagram.com/mabebezababy?igshid=YmMyMTA2M2Y=" class="text-dark"><i class="fab fa-instagram"></i> &nbsp; MabebezaBaby</a> <br>
                <a href="https://www.facebook.com/mabebezababy" class="text-dark"><i class="fab fa-facebook" ></i> &nbsp; MabebezaBaby</a>
            </div>
           </div>
          </div>
          <hr>
          <div class="mt-3 pt-3"><p class="h5 text-purple">Store Address</p></div>
          <div class="row mt-3 pb-3">
            <div class="col-md-6">
              <p class="">
               <span> Mabebeza Shop 32b</span> <br> 
               <span>Tembisa Megamart</span> , <br>
                Cnr Olifanstsfontein & Algeria Rd, <br>
                 Gauteng, South Africa
              </p>
            </div>
            <div class="col-md-6">
              <p class="">
                <span> Mabebeza Shop 32b</span> <br> 
                <span>Tembisa Megamart</span> , <br>
                 Cnr Olifanstsfontein & Algeria Rd, <br>
                  Gauteng, South Africa
              </p>
            </div>
          </div>
        </div>
        
    </div> 
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7uUbl0Ol0kXBam07UPsjThrxL18qoVzA&callback=initMap&v=weekly"
    defer
  ></script>
    <script>
        const { createApp } = Vue;
    </script>
     <script>
        //  creates a simple polygon.
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 11,
      center: { lng: 28.112411, lat: -25.981459 },
      mapTypeId: "terrain",
    });

    let mt = { lng: 28.212632, lat: -25.964747 };  //  
    let md = { lng: 27.994393, lat: -25.932238 }; //  

    
 
    const mtm = new google.maps.Marker({
        position: mt,
        map: map,
        title: 'Mabebeza Shop 32b Tembisa Megamart, Cnr Olifanstsfontein & Algeria Rd, Tembisa, South Africa'
      });
      const mdm = new google.maps.Marker({
        position: md,
        map: map,
        title: 'Mabebeza Bambanani'
      }); 
    // Define the LatLng coordinates for the polygon's path.
    const triangleCoords = [
      { lng: 28.253860, lat: -26.039158 },   //tembisa
      { lng: 28.233604, lat: -25.922497 },   // olif 
      { lng: 28.103484, lat: -25.890379 },   // oliv
      { lng: 27.991027, lat: -25.928719 },   //diepsloot   
      { lng: 27.913627, lat: -26.025276 },   //cosmo
      { lng: 27.999801, lat: -26.033297 },   // 4way
      { lng: 28.089065, lat: -26.051496 },   // woodmed
      { lng: 28.253860, lat: -26.039158 },   // tembisa
    ]; 
    // Construct the polygon.
    const bermudaTriangle = new google.maps.Polygon({
      paths: triangleCoords,
      strokeColor: "#642c94",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#dd99b0",
      fillOpacity: 0.50,
    });
    bermudaTriangle.setMap(map);
  }
  window.initMap = initMap;
      </script>
</x-guest-layout> 
