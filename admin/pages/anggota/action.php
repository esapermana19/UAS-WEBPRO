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
    elseif ($act == "edit_anggota") {

        // kode lama (sebelum diedit)
        $kode_lama = $_GET['kode_anggota'];

        // data baru dari form
        $kode_baru   = $_POST['kode_anggota'];
        $nama_anggota = $_POST['nama_anggota'];
        $jk           = $_POST['jk'];
        $alamat       = $_POST['alamat'];
        $no_hp        = $_POST['no_hp'];

        // CEK KODE ANGGOTA (cek duplikasi, KECUALI data sendiri)
        $query_check_anggota = "
            SELECT * FROM anggota 
            WHERE kode_anggota = '$kode_baru'
            AND kode_anggota != '$kode_lama'
        ";
        $execute_check_anggota = mysqli_query($koneksi, $query_check_anggota);

        if (mysqli_num_rows($execute_check_anggota) > 0) {
            $_SESSION['message'] = 'Kode anggota sudah digunakan';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            header('location: ../../dashboard.php?page=anggota');
            exit;
        }

        // UPDATE DATA (WHERE pakai kode lama)
        $sql = "
            UPDATE anggota SET
                kode_anggota = '$kode_baru',
                nama_anggota = '$nama_anggota',
                jk           = '$jk',
                alamat       = '$alamat',
                no_hp        = '$no_hp'
            WHERE kode_anggota = '$kode_lama'
        ";

        $execute = mysqli_query($koneksi, $sql);

        if ($execute && mysqli_affected_rows($koneksi) > 0) {
            $_SESSION['message'] = 'Data anggota berhasil diperbarui';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
        } else {
            $_SESSION['message'] = 'Tidak ada perubahan data';
            $_SESSION['alert_type'] = 'alert-warning';
            $_SESSION['type'] = 'warning';
        }

        header('location: ../../dashboard.php?page=anggota');
        exit;
    }

    //HAPUS
    elseif ($act == "delete") {
        $kode_anggota = $_GET['kode_anggota'];
        $sql = "DELETE FROM anggota WHERE kode_anggota='$kode_anggota'";
        $execute = mysqli_query($koneksi, $sql);
        if ($execute) {
            $_SESSION['message'] = 'anggota has been deleted';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        } else {
            $_SESSION['message'] = 'anggota failed deleted';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=anggota');
            exit;
        }
    }
}
