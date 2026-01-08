<?php
$koneksi = mysqli_connect("localhost","root","","uas_web");
if(!$koneksi) {
    mysqli_connect_errno();
    die;
}
?>