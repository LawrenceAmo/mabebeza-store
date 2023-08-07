<html>
  <head>
    <title>Simple Polygon</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script type="module" src="./index.js"></script>
    <style>
      /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
#map {
  height: 100%;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
    </style>
  </head>
  <body>
    <div id="map"></div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7uUbl0Ol0kXBam07UPsjThrxL18qoVzA&callback=initMap&v=weekly"
      defer
    ></script>
    
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
    { lng: 28.253860, lat: -26.039158 }, //tembisa
    { lng: 28.223991, lat: -25.916012 }, // olif
    { lng: 28.103484, lat: -25.890379 },  // ilov
    { lng: 28.003234, lat:  -25.927746},  //diepsloot
    { lng: 27.913627, lat: -26.025276},    //cosmo
    { lng: 27.999801, lat: -26.033297},   // 4way
    { lng: 28.089065, lat: -26.051496},   // woodmed
    { lng: 28.253860, lat: -26.039158},   // tembisa
  ];
  // Construct the polygon.
  const bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords,
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.30,
  });
  bermudaTriangle.setMap(map);
}
window.initMap = initMap;
    </script>
  </body>
</html>