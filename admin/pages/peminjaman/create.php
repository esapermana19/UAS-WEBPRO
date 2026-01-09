<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/UAS_WEB/config/koneksi.php';


/*
GENERATE KODE PEMINJAMAN
FORMAT: PJM/YYYYMMDD/001
*/
$today = date('Ymd');

$q = mysqli_query($koneksi, "
    SELECT id_peminjaman 
    FROM peminjaman 
    WHERE id_peminjaman LIKE 'PJM/$today%' 
    ORDER BY id_peminjaman DESC 
    LIMIT 1
");

if ($d = mysqli_fetch_assoc($q)) {
    $urut = (int) substr($d['id_peminjaman'], -3) + 1;
} else {
    $urut = 1;
}

$id_peminjaman = "PJM/$today/" . sprintf("%03d", $urut);

/*
DATA MASTER
*/
$q_anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
if(!$q_anggota) {
    die("Query anggota gagal: " . mysqli_error($koneksi));
}

$q_buku    = mysqli_query($koneksi, "SELECT * FROM buku");
if(!$q_buku) {
    die("Query buku gagal: " . mysqli_error($koneksi));
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Peminjaman</h1>

    <form action="pages/peminjaman/action.php?act=insert" method="POST">

        <!-- HEADER PEMINJAMAN -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <div>
                <label class="block text-sm font-medium">Kode Peminjaman</label>
                <input type="text" name="id_peminjaman" 
                    value="<?= $id_peminjaman ?>" 
                    readonly
                    class="mt-1 w-full border rounded px-3 py-2 bg-gray-100">
            </div>

            <div>
                <label class="block text-sm font-medium">Anggota</label>
                <select name="kode_anggota" required
                    class="mt-1 w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Anggota --</option>
                    <?php while ($a = mysqli_fetch_assoc($q_anggota)) { ?>
                        <option value="<?= $a['kode_anggota'] ?>">
                            <?= $a['nama_anggota'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam"
                    value="<?= date('Y-m-d') ?>"
                    required
                    class="mt-1 w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium">Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" required
                    class="mt-1 w-full border rounded px-3 py-2">
            </div>
        </div>

        <!-- DETAIL BUKU -->
        <div class="mb-4">
            <h2 class="font-semibold mb-2">Daftar Buku</h2>

            <table class="w-full border" id="bukuTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2 text-left">Buku</th>
                        <th class="border p-2 w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2">
                            <select name="kode_buku[]" required
                                class="w-full border rounded px-2 py-1">
                                <option value="">-- Pilih Buku --</option>
                                <?php 
                                mysqli_data_seek($q_buku, 0);
                                while ($b = mysqli_fetch_assoc($q_buku)) { ?>
                                    <option value="<?= $b['kode_buku'] ?>">
                                        <?= $b['judul'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="border p-2 text-center">
                            <button type="button"
                                onclick="hapusBaris(this)"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                X
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button"
                onclick="tambahBaris()"
                class="mt-3 bg-green-600 text-white px-4 py-2 rounded">
                + Tambah Buku
            </button>
        </div>

        <!-- SUBMIT -->
        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded font-semibold">
                Simpan Peminjaman
            </button>
        </div>

    </form>
</div>

<script>
function tambahBaris() {
    let table = document.querySelector('#bukuTable tbody');
    let row = table.rows[0].cloneNode(true);
    row.querySelector('select').selectedIndex = 0;
    table.appendChild(row);
}

function hapusBaris(btn) {
    let table = document.querySelector('#bukuTable tbody');
    if (table.rows.length > 1) {
        btn.closest('tr').remove();
    }
}
</script>

</body>
</html>
