<?php include "header.php"; ?>
<?php
$id = $_GET['id_hs'];
include_once "ambildata_id.php";
$obj = json_decode($data);
$id_hs = "";
$hs_name = "";
$hs_address = "";
$hs_desc = "";
$lat = "";
$long = "";
foreach ($obj->results as $item) {
  $id_hs .= $item->id_hs;
  $hs_name .= $item->hs_name;
  $hs_address .= $item->hs_address;
  $hs_desc .= $item->hs_desc;
  $lat .= $item->latitude;
  $long .= $item->longitude;
}

$title = "Detail and Location : " . $hs_name;
//include_once "header.php"; 
?>
<script>
var map;
function haversine_distance(mk1, mk2) {
            var R = 3958.8; // Radius of the Earth in miles
            var rlat1 = mk1.position.lat() * (Math.PI / 180); // Convert degrees to radians
            var rlat2 = mk2.position.lat() * (Math.PI / 180); // Convert degrees to radians
            var difflat = rlat2 - rlat1; // Radian difference (latitudes)
            var difflon = (mk2.position.lng() - mk1.position.lng()) * (Math.PI / 180); // Radian difference (longitudes)

            var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
            return d;
        }
function initMap() {
            // The map, centered on Central Park
            const center = { lat: -6.336715088372908, lng: 107.16635840420123 };
            const options = { zoom: 15, scaleControl: true, center: center };
            map = new google.maps.Map(
                document.getElementById('map'), options);
            // Locations of landmarks
            const loc1 = { lat: <?php echo $_COOKIE["latitude"]; ?>, lng:  <?php echo $_COOKIE["longitude"]; ?>};
            const loc2 = { lat: <?php echo $lat; ?>, lng: <?php echo $long; ?> };
            // The markers for The loc1 and The loc2 Collection
            var mk1 = new google.maps.Marker({ position: loc1, map: map });
            var mk2 = new google.maps.Marker({ position: loc2, map: map });
            // Draw a line showing the straight distance between the markers
            var line = new google.maps.Polyline({ path: [loc1, loc2], map: map });
            // Calculate and display the distance between markers
            var distance = haversine_distance(mk1, mk2);
            document.getElementById('msg').innerHTML = "Distance from your location: " + distance.toFixed(2) + " miles. <p>";

            let directionsService = new google.maps.DirectionsService();
            let directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map); // Existing map object displays directions
            // Create route from existing points used for markers
            const route = {
                origin: loc1,
                destination: loc2,
                travelMode: 'DRIVING'
            }

            directionsService.route(route,
                function (response, status) { // anonymous function to capture directions
                    if (status !== 'OK') {
                        window.alert('Directions request failed due to ' + status);
                        return;
                    } else {
                        directionsRenderer.setDirections(response); // Add route to the map
                        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                        if (!directionsData) {
                            window.alert('Directions request failed');
                            return;
                        }
                        else {
                            document.getElementById('msg').innerHTML += " Driving distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
                        }
                    }
                });
        }
 </script> 

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7LwW7hPdg7eg4D-f68f9N8WrwAOSb8j4&callback=initMap">
        </script>

<!-- start banner Area -->
<section class="about-banner relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Hospital Detail
        </h1>

      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->
<!-- Start about-info Area -->
<section class="about-info-area section-gap">
  <div class="container" style="padding-top: 120px;">
    <div class="row">

      <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-heading centered">
            <h2 class="panel-title"><strong>Hospital Information</strong></h4>
          </div>
          <div class="panel-body">
            
            <table class="table">
              <tr>
                <!-- <th>Item</th> -->
                <th>Detail</th>
              </tr>
              <tr>
                <td>Hospital Name</td>
                <td>
                  <h5><?php echo $hs_name ?></h5>
                </td>
              </tr>
              <tr>
                <td>Hospital Address</td>
                <td>
                  <h5><?php echo $hs_address ?></h5>
                </td>
              </tr>
              <tr>
                <td>Hospital Description</td>
                <td>
                  <h5><?php echo $hs_desc ?></h5>
                </td>
              </tr>
            </table>
          </div>
          <h5><div id="msg"></div></h4>
          
        </div>
      </div>

      <div class="col-md-5" data-aos="zoom-in">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-heading centered">
            <h2 class="panel-title"><strong>Location</strong></h4>
          </div>
          <div class="panel-body">
            <div id="map" style="width:100%;height:380px;"></div>
          </div>
        </div>
      </div>
</section>
<!-- End about-info Area -->
<?php include "footer.php"; ?> 

