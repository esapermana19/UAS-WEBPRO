<?php
include "../../../config/koneksi.php";
session_start();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == "insert") {
        $kode_anggota = $_POST['kode_anggota'];
        $nama_anggota = $_POST['nama_anggota'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        //CEK KODE ANGGOTA
        $query_check_anggota = "SELECT * FROM anggota where kode_anggota='$kode_anggota'";
        $execute_check_anggota = mysqli_query($koneksi, $query_check_anggota);
        $check_anggota = mysqli_num_rows($execute_check_anggota);
        if ($check_anggota > 0) {
            $_SESSION['message'] = 'anggota code is already';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        }

        $sql = "INSERT INTO anggota (kode_anggota,alamat,nama_anggota,no_hp,jk)
        VALUES ('$kode_anggota','$alamat','$nama_anggota','$no_hp','$jk')";
        $execute = mysqli_query($koneksi, $sql);

        if ($execute) {
            $_SESSION['message'] = 'anggota has been saved';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        } else {
            $_SESSION['message'] = 'anggota failed saved';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        }
    }

    // UPDATE
    elseif ($act == "update") {
        $anggota_id = $_GET['anggota_id'];
        $kode_anggota = $_POST['kode_anggota'];
        $nama_anggota = $_POST['nama_anggota'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        //CEK KODE PRODUK
        $query_check_anggota = "SELECT * FROM anggotas where kode_anggota='$kode_anggota'
        AND anggota_id != '$anggota_id'";
        $execute_check_anggota = mysqli_query($koneksi, $query_check_anggota);
        $check_anggota = mysqli_num_rows($execute_check_anggota);
        if ($check_anggota > 0) {
            $_SESSION['message'] = 'kode anggota is already';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        }

        $sql = "UPDATE anggotas SET kode_anggota='$kode_anggota',nama_anggota='$nama_anggota',
        alamat='$alamat',no_hp='$no_hp',jk='$jk' WHERE anggota_id='$anggota_id'";

        $execute = mysqli_query($koneksi, $sql);
        if ($execute) {
            $_SESSION['message'] = 'anggota has been edited';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'succes';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggotas');
            exit;
        } else {
            $_SESSION['message'] = 'anggota failed edited';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggotas');
            exit;
        }
    }
    //HAPUS
    elseif($act == "delete") {
        $anggota_id = $_GET['anggota_id'];
        $sql = "DELETE FROM anggotas WHERE anggota_id='$anggota_id'";
        $execute = mysqli_query($koneksi,$sql);
        if ($execute) {
            $_SESSION['message'] = 'anggota has been deleted';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'succes';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggotas');
            exit;
        } else {
            $_SESSION['message'] = 'anggota failed deleted';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggotas');
            exit;
        }

    }
}
