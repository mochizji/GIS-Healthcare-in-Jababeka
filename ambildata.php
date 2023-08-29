<?php
include "koneksi.php";
$Q = mysqli_query($koneksi, "SELECT ST_X(hs_geom) as latitude, ST_Y(hs_geom) as longitude, id_hs, hs_name, hs_address, hs_desc FROM hospital");
if ($Q) {
        $posts = array();
        if (mysqli_num_rows($Q)) {
                while ($post = mysqli_fetch_assoc($Q)) {
                        $posts[] = $post;
                }
        }
        $data = json_encode(array('results' => $posts));
        echo $data;
} else {
        echo "error";
}
?>
