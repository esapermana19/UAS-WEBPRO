<?php
include "../../../config/koneksi.php";
session_start();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == "insert") {
        $kategori_id = $_POST['kategori_id'];
        $nama_kategori = $_POST['nama_kategori'];
        //CEK ID kategori
        $query_check_kategori = "SELECT * FROM kategori where kategori_id='$kategori_id'";
        $execute_check_kategori = mysqli_query($koneksi, $query_check_kategori);
        $check_kategori = mysqli_num_rows($execute_check_kategori);
        if ($check_kategori > 0) {
            $_SESSION['message'] = 'ID Kategori sudah ada';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=kategori');
            exit;
        }

        $sql = "INSERT INTO kategori (kategori_id,nama_kategori)
        VALUES ('$kategori_id','$nama_kategori')";
        $execute = mysqli_query($koneksi, $sql);

        if ($execute) {
            $_SESSION['message'] = 'Kategori berhasil ditambahkan';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=kategori');
            exit;
        } else {
            $_SESSION['message'] = 'kategori gagal ditambahkan';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=kategori');
            exit;
        }
    }

    // UPDATE
    elseif ($act == "edit_kategori") {

        // ID lama (sebelum diedit)
        $ID_lama = $_GET['kategori_id'];

        // data baru dari form
        $ID_baru   = $_POST['kategori_id'];
        $nama_kategori = $_POST['nama_kategori'];

        // CEK ID kategori (cek duplikasi, KECUALI data sendiri)
        $query_check_kategori = "
            SELECT * FROM kategori 
            WHERE kategori_id = '$ID_baru'
            AND kategori_id != '$ID_lama'
        ";
        $execute_check_kategori = mysqli_query($koneksi, $query_check_kategori);

        if (mysqli_num_rows($execute_check_kategori) > 0) {
            $_SESSION['message'] = 'ID kategori sudah digunakan';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            header('location: ../../dashboard.php?page=kategori');
            exit;
        }

        // UPDATE DATA (WHERE pakai ID lama)
        $sql = "
            UPDATE kategori SET
                kategori_id = '$ID_baru',
                nama_kategori = '$nama_kategori'
            WHERE kategori_id = '$ID_lama'
        ";

        $execute = mysqli_query($koneksi, $sql);

        if ($execute && mysqli_affected_rows($koneksi) > 0) {
            $_SESSION['message'] = 'Data kategori berhasil diperbarui';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
        } else {
            $_SESSION['message'] = 'Tidak ada perubahan data';
            $_SESSION['alert_type'] = 'alert-warning';
            $_SESSION['type'] = 'warning';
        }

        header('location: ../../dashboard.php?page=kategori');
        exit;
    }

    //HAPUS
    elseif ($act == "delete") {
        $kategori_id = $_GET['kategori_id'];
        $sql = "DELETE FROM kategori WHERE kategori_id='$kategori_id'";
        $execute = mysqli_query($koneksi, $sql);
        if ($execute) {
            $_SESSION['message'] = 'kategori berhasil dihapus';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=kategori');
            exit;
        } else {
            $_SESSION['message'] = 'kategori gagal dihapus';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=kategori');
            exit;
        }
    }
}
