<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

// 1️⃣ Start session di paling atas
session_start();

// 2️⃣ Koneksi database
include "../../../config/koneksi.php";
// 3️⃣ Ambil act
if(!isset($_GET['act'])) exit;
$act = $_GET['act'];

// 4️⃣ Ambil id_user dari session login
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 1; // default admin = 1

// 5️⃣ Logic insert
if($act=='insert') {
    $id_peminjaman = mysqli_real_escape_string($koneksi,$_POST['id_peminjaman']);
    $kode_anggota    = mysqli_real_escape_string($koneksi,$_POST['kode_anggota']);
    $tgl_pinjam      = mysqli_real_escape_string($koneksi,$_POST['tgl_pinjam']);
    $tgl_kembali     = mysqli_real_escape_string($koneksi,$_POST['tgl_kembali']);
    $kode_buku_list  = $_POST['kode_buku']; // array

    // INSERT KE TABEL PEMINJAMAN
    $sql = "INSERT INTO peminjaman (id_peminjaman, kode_anggota, tgl_pinjam, tgl_kembali, id_user) 
            VALUES ('$id_peminjaman','$kode_anggota','$tgl_pinjam','$tgl_kembali','$id_user')";
    $exe = mysqli_query($koneksi,$sql);

    if(!$exe){
        $_SESSION['message']='Gagal tambah peminjaman: '.mysqli_error($koneksi);
        $_SESSION['type']='failed';
        header('location: ../../dashboard.php?page=peminjaman');
        exit;
    }

    // INSERT DETAIL BUKU
    foreach($kode_buku_list as $kode_buku){
        $kb = mysqli_real_escape_string($koneksi,$kode_buku);
        mysqli_query($koneksi, "INSERT INTO detail_peminjaman (id_peminjaman,kode_buku,status) 
                               VALUES ('$id_peminjaman','$kb','dipinjam')");
    }

    $_SESSION['message']='Peminjaman berhasil ditambahkan';
    $_SESSION['type']='success';
    header('location: ../../dashboard.php?page=peminjaman');
    exit;
}
