<?php include "header.php"; ?>
<!-- start banner Area -->
<section class="about-banner relative">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Healthcare Data
        </h1>
        <p class="text-white link-nav">This page contains healthcare information in Jababeka </p>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->
<!-- Start about-info Area -->
<section class="about-info-area section-gap">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 info-left">
        <img class="img-fluid" src="img/about/info-img.jpg" alt="">
      </div>

      <div class="col-lg-30 into-right" data-aos="fade-up" data-aos-delay="100">

        <div class="col-md-12">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">

            </div>
            <div class="panel-body">
              <table class="table table-bordered table-striped table-admin">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="30%">Healthcare Name</th>
                    <th width="30%">Healthcare Address</th>
                    <th width="20%">Healthcare Description</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data = file_get_contents('http://localhost:8080/gis-hospital/ambildata.php');
                  $no = 1;
                  if (json_decode($data, true)) {
                    $obj = json_decode($data);
                    foreach ($obj->results as $item) {
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $item->hs_name; ?></td>
                        <td><?php echo $item->hs_address; ?></td>
                        <td><?php echo $item->hs_desc; ?></td>
                        <td class="ctr">
                          <div class="btn-group">
                            <a href="detail.php?id_hs=<?php echo $item->id_hs; ?>" rel="tooltip" data-original-title="Lihat File" data-placement="top" class="btn btn-primary">
                              <i class="fa fa-map-marker"> </i> Detail</a>&nbsp;
                          </div>
                        </td>
                      </tr>
                  <?php $no++;
                    }
                  } else {
                    echo "data tidak ada.";
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<script>
  
      const http = new XMLHttpRequest();
      document.addEventListener("mousemove", () => {
    findMyCoordinates()
})


function findMyCoordinates() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
             const bdcApi = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${position.coords.latitude}&longitude=${position.coords.longitude}`
            getApi(bdcApi);
        },
            (err) => {
                alert(err.message)
            })
    } else {
        alert("Geolocation is not supported by your browser")
    }
}

function getApi(bdcApi) {
    http.open("GET", bdcApi);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const latresults = JSON.parse(this.responseText).latitude
            const longresults = JSON.parse(this.responseText).longitude
            createCookie("latitude", latresults, "2");
            createCookie("longitude", longresults, "2");
        }
    };
}
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}
    </script>
<!-- End about-info Area -->
<?php include "footer.php"; ?>