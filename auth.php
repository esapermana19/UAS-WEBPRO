<?php
session_start();
include "config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

$cekuser = mysqli_num_rows($query);
if ($cekuser > 0) {
    $datauser = mysqli_fetch_array($query);
    $_SESSION['login'] = true;
    $_SESSION['username'] = $datauser['username'];
    $_SESSION['email'] = $datauser['email'];
    mysqli_close($koneksi);
    header("Location:admin/dashboard.php");
} else {
    $_SESSION['message'] = 'Email Atau Password Salah';
    mysqli_close($koneksi);
    header("Location:login.php");
}



