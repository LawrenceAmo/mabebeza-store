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
                    <li>Tembisa</li>
                    <li>Midrand</li>
                    <li>Fourways</li>
                    <li>Sunninghill</li>
                    <li>Waterfall city</li>
                    <li>Farmall</li>
                    <li>Diepsloot</li>
                    <li>Olieven</li>
                    <li>Randjespark</li>
                    <li>Noordwyk</li>
                    <li>Olifants</li>
                    <li>Clayville</li>
                </ol>
            </div>                  
            </div>
            <div class=" col-md-8 col-sm-12 ">
                <div   class="  ">
                    <div id="map"></div>
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
        // This example creates a simple polygon representing the Bermuda Triangle.
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 11,
      center: { lng: 28.112411, lat: -25.981459 },
      mapTypeId: "terrain",
    });
    // Define the LatLng coordinates for the polygon's path.
    const triangleCoords = [
      { lng: 28.253860, lat: -26.039158 },   //tembisa
      { lng: 28.233604, lat: -25.922497 },   // olif 
      { lng: 28.103484, lat: -25.890379 },   // oliv
      { lng: 28.003234, lat: -25.927746 },   //diepsloot
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
