<?php include "header.php"; ?>

<!-- start banner Area -->
<section class="banner-area relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row fullscreen align-items-center justify-content-between">
      <div class="col-lg-6 col-md-6 banner-left">
        <h6 class="text-white">GEOGRAPHIC INFORMATION SYSTEM HOSPITAL</h6>
        <h1 class="text-white">JABABEKA AREA</h1>
        <p class="text-white">
          This application contains information and locations of hospitals, clinics, and puskesmas in Jababeka 
        </p>
        <a href="#peta_wisata" class="primary-btn text-uppercase">DETAIL</a>
      </div>

    </div>
  </div>
  </div>
</section>
<!-- End banner Area -->


<main id="main">




  <!-- Start about-info Area -->
  <section class="price-area section-gap">

    <section id="peta_wisata" class="about-info-area section-gap">
      <div class="container">

        <div class="title text-center">
          <h1 class="mb-10">Healthcare Map Location</h1>
          <br>
        </div>

        <div class="row align-items-center">

          <div id="map" style="width:100%;height:480px;"></div>

          <script>
            function initMap() {
            const myLatLng = { lat: -6.2845308007588265, lng: 107.17384392768136 };
            const myLatLng2 = { lat: -6.2763116268365, lng: 107.18113643917377 };
            const myLatLng3 = { lat: -6.2994334437135855, lng: 107.16733642813907 };
            const myLatLng4 = { lat: -6.299022176450128, lng: 107.1596817680696 };
            const myLatLng5 = { lat: -6.292265692858014, lng: 107.15033105337349 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "RS Permata Keluarga Jababeka",
            });
            new google.maps.Marker({
                position: myLatLng2,
                map,
                title: "Asri Medika Hospital",
            });
            new google.maps.Marker({
                position: myLatLng3,
                map,
                title: "RS Metro Cikarang",
            });
            new google.maps.Marker({
                position: myLatLng4,
                map,
                title: "RS Harapan Keluarga",
            });
            new google.maps.Marker({
                position: myLatLng5,
                map,
                title: "RS Mitra Keluarga",
            });
        }
            window.initMap = initMap;
          </script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7LwW7hPdg7eg4D-f68f9N8WrwAOSb8j4&callback=initMap"></script>
        </div>


      </div>
    </section>
    <!-- End about-info Area -->


    <!-- Start price Area -->

    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Map Coverage</h1>
            <p>This healthcare geographic mapping application in Jababeka contains information and locations of hospitals, clinics and health centers. The mapping is taken from Google Maps location data and data from the website of each tourist spot. This application contains some information about" 
            </p>
          </div>
        </div>
      </div>

      <!-- End other-issue Area -->

    </div>
    </div> <!-- ======= Counts Section ======= -->
    <section id="counts">
      <div class="container">
        <div class="title text-center">
          <h1 class="mb-10">Number of Healthcare</h1>
          <br>
        </div>
        <div class="row d-flex justify-content-center">


          <?php
          include_once "counths.php";
          $obj = json_decode($data);
          $hosp = "";
          foreach ($obj->results as $item) {
            $hosp .= $item->hos;
          }
          ?>

          <div class="text-center">
            <h1><span data-toggle="counter-up"><?php echo $hosp; ?></span></h1>
            <br>
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->
    </div>
  </section>
  <!-- End testimonial Area -->


  <?php include "footer.php"; ?>