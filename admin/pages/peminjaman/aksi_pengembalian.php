<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../../config/koneksi.php'; // SESUAIKAN PATH

// VALIDASI PARAMETER
if (!isset($_GET['id_detail'])) {
    die('ID detail peminjaman tidak ditemukan');
}

$id_detail = mysqli_real_escape_string($koneksi, $_GET['id_detail']);
$tgl_hari_ini = date('Y-m-d');

/* 
AMBIL DATA PEMINJAMAN
*/
$sql = "
    SELECT 
        dp.id_detail_peminjaman,
        dp.id_peminjaman,
        p.tgl_kembali
    FROM detail_peminjaman dp
    JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
    WHERE dp.id_detail_peminjaman = '$id_detail'
";

$query = mysqli_query($koneksi, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    die('Data peminjaman tidak ditemukan');
}

$data = mysqli_fetch_assoc($query);

/*
HITUNG TERLAMBAT
*/
$hari_terlambat = 0;
$keterangan = 'Dikembalikan tepat waktu';

if ($tgl_hari_ini > $data['tgl_kembali']) {
    $hari_terlambat = (strtotime($tgl_hari_ini) - strtotime($data['tgl_kembali'])) / 86400;
    $keterangan = "Terlambat $hari_terlambat hari";
}

/*
UPDATE DETAIL PEMINJAMAN
*/
$update = mysqli_query($koneksi, "
    UPDATE detail_peminjaman SET
        status = 'dikembalikan',
        tgl_dikembalikan = '$tgl_hari_ini',
        hari_terlambat = '$hari_terlambat',
        keterangan = '$keterangan'
    WHERE id_detail_peminjaman = '$id_detail'
");

if (!$update) {
    die('Gagal update: ' . mysqli_error($koneksi));
}

/*
FLASH MESSAGE
*/
$_SESSION['type'] = 'success';
$_SESSION['message'] = 'Buku berhasil dikembalikan';

/*
REDIRECT KEMBALI KE DETAIL
*/
header("Location: ../../dashboard.php?page=detail_peminjaman&id=" . $data['id_peminjaman']);
exit;