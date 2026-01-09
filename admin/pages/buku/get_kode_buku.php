<?php
include "../../../config/koneksi.php";

$kategori_id = $_GET['kategori_id'] ?? '';

if ($kategori_id == '') {
    echo '';
    exit;
}

$sql = "
    SELECT kode_buku 
    FROM buku 
    WHERE kode_buku LIKE '$kategori_id%' 
    ORDER BY kode_buku DESC 
    LIMIT 1
";

$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo 'ERROR_SQL';
    exit;
}

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    $lastKode = $data['kode_buku'];
    $nomor = (int) substr($lastKode, 3, 3);
    $nomor++;
} else {
    $nomor = 1;
}

$nomorBaru = str_pad($nomor, 3, '0', STR_PAD_LEFT);
echo $kategori_id . $nomorBaru;
