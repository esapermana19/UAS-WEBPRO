<?php
include "../../../config/koneksi.php";
session_start();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if ($act == "insert") {
        $kode_buku = $_POST['kode_buku'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $kategori_id = $_POST['kategori_id'];
        $stok = $_POST['stok'];
        //CEK KODE BUKU
        $query_check_buku = "SELECT * FROM buku where kode_buku='$kode_buku'";
        $execute_check_buku = mysqli_query($koneksi, $query_check_buku);
        $check_buku = mysqli_num_rows($execute_check_buku);
        if ($check_buku > 0) {
            $_SESSION['message'] = 'Kode buku sudah ada';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=buku');
            exit;
        }

        $sql = "INSERT INTO buku (kode_buku,penerbit,judul,tahun_terbit,pengarang,kategori_id,stok)
        VALUES ('$kode_buku','$penerbit','$judul','$tahun_terbit','$pengarang','$kategori_id','$stok')";
        $execute = mysqli_query($koneksi, $sql);

        if ($execute) {
            $_SESSION['message'] = 'buku berhasil disimpan';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=buku');
            exit;
        } else {
            $_SESSION['message'] = 'buku gagal disimpan';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=buku');
            exit;
        }
    }

    // UPDATE
    elseif ($act == "edit_buku") {

        // kode lama (sebelum diedit)
        $kode_lama = $_GET['kode_buku'];

        // data baru dari form
        $kode_baru = $_POST['kode_buku'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $kategori_id = $_POST['kategori_id'];
        $stok = $_POST['stok'];

        // CEK KODE buku (cek duplikasi, KECUALI data sendiri)
        $query_check_buku = "
            SELECT * FROM buku 
            WHERE kode_buku = '$kode_baru'
            AND kode_buku != '$kode_lama'
        ";
        $execute_check_buku = mysqli_query($koneksi, $query_check_buku);

        if (mysqli_num_rows($execute_check_buku) > 0) {
            $_SESSION['message'] = 'Kode buku sudah digunakan';
            $_SESSION['alert_type'] = 'alert-danger';
            $_SESSION['type'] = 'failed';
            header('location: ../../dashboard.php?page=buku');
            exit;
        }

        // UPDATE DATA (WHERE pakai kode lama)
        $sql = "
            UPDATE buku SET
                kode_buku = '$kode_baru',
                judul = '$judul',
                pengarang = '$pengarang',
                penerbit = '$penerbit',
                tahun_terbit = '$tahun_terbit',
                kategori_id = '$kategori_id',
                stok = '$stok'
            WHERE kode_buku = '$kode_lama'
        ";

        $execute = mysqli_query($koneksi, $sql);

        if ($execute && mysqli_affected_rows($koneksi) > 0) {
            $_SESSION['message'] = 'Data buku berhasil diperbarui';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
        } else {
            $_SESSION['message'] = 'Tidak ada perubahan data';
            $_SESSION['alert_type'] = 'alert-warning';
            $_SESSION['type'] = 'warning';
        }

        header('location: ../../dashboard.php?page=buku');
        exit;
    }

    //HAPUS
    elseif ($act == "delete") {
        $kode_buku = $_GET['kode_buku'];
        $sql = "DELETE FROM buku WHERE kode_buku='$kode_buku'";
        $execute = mysqli_query($koneksi, $sql);
        if ($execute) {
            $_SESSION['message'] = 'buku berhasil dihapus';
            $_SESSION['alert_type'] = 'alert-success';
            $_SESSION['type'] = 'success';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=buku');
            exit;
        } else {
            $_SESSION['message'] = 'buku gagal dihapus';
            $_SESSION['alert_type'] = 'alert-failed';
            $_SESSION['type'] = 'failed';
            mysqli_close($koneksi);
            header('location: ../../dashboard.php?page=buku');
            exit;
        }
    }
}
