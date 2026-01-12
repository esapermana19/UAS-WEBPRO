<?php
// asumsi: session & koneksi sudah dipanggil sebelumnya
// contoh:
// session_start();
// include '../../koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// CEK PARAMETER ID
if (!isset($_GET['id'])) {
    die('ID peminjaman tidak ditemukan');
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$today = new DateTime(date('Y-m-d'));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-4 pb-4 border-b">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Peminjaman</h1>
            <div class="justify-end">
                <a href="dashboard.php?page=peminjaman"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mx-2">
                    Kembali
                </a>

                <a href="pages/peminjaman/print_detail.php?id=<?php echo $id; ?>"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mx-2"
                    target="_blank">
                    Print
                </a>
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="w-full">
                <thead class="bg-gray-100 text-sm text-gray-600">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Judul Buku</th>
                        <th class="px-4 py-3">Tgl Pinjam</th>
                        <th class="px-4 py-3">Tgl Kembali</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Hari Terlambat</th>
                        <th class="px-4 py-3">Tgl Dikembalikan</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Pengembalian</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    <?php
                    $sql = "
                    SELECT 
                        dp.id_detail_peminjaman,
                        b.judul,
                        p.tgl_pinjam,
                        p.tgl_kembali,
                        dp.status,
                        dp.tgl_dikembalikan,
                        dp.hari_terlambat,
                        dp.keterangan
                    FROM detail_peminjaman dp
                    JOIN buku b ON dp.kode_buku = b.kode_buku
                    JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
                    WHERE dp.id_peminjaman = '$id';";

                    $query = mysqli_query($koneksi, $sql);

                    // ===== DEBUG QUERY =====
                    if (!$query) {
                        echo '<tr><td colspan="9" class="text-red-600 p-4">';
                        echo 'Query Error: ' . mysqli_error($koneksi);
                        echo '</td></tr>';
                    }

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) :

                        // AMANKAN TGL KEMBALI
                        $tgl_kembali = (!empty($row['tgl_kembali']) && $row['tgl_kembali'] !== '0000-00-00')
                            ? new DateTime($row['tgl_kembali'])
                            : null;

                        // HITUNG KETERLAMBATAN
                        if ($row['status'] === 'dipinjam') {
                            if ($tgl_kembali && $today > $tgl_kembali) {
                                $hari_terlambat = $today->diff($tgl_kembali)->days;
                                $keterangan = "Terlambat $hari_terlambat hari";
                            } else {
                                $hari_terlambat = 0;
                                $keterangan = "Belum jatuh tempo";
                            }
                        } else {
                            $hari_terlambat = $row['hari_terlambat'] ?? 0;
                            $keterangan = $row['keterangan'] ?? 'Dikembalikan';
                        }
                    ?>
                        <tr class="text-sm hover:bg-gray-50">
                            <td class="px-4 py-3"><?= $no++; ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['judul']); ?></td>
                            <td class="px-4 py-3"><?= $row['tgl_pinjam']; ?></td>
                            <td class="px-4 py-3"><?= $row['tgl_kembali'] ?? '-'; ?></td>

                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                        <?= $row['status'] === 'dipinjam'
                            ? 'bg-yellow-100 text-yellow-700'
                            : 'bg-green-100 text-green-700'; ?>">
                                    <?= ucfirst($row['status']); ?>
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <?= $hari_terlambat > 0 ? $hari_terlambat . ' hari' : '-' ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= $row['tgl_dikembalikan'] ?? '-' ?>
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded
                        <?= $hari_terlambat > 0
                            ? 'bg-red-100 text-red-700'
                            : 'bg-blue-100 text-blue-700'; ?>">
                                    <?= $keterangan ?>
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <?php if ($row['status'] === 'dipinjam') : ?>
                                    <a href="pages/peminjaman/aksi_pengembalian.php?id_detail=<?= $row['id_detail_peminjaman']; ?>"
                                        onclick="return confirm('Konfirmasi pengembalian buku?')"
                                        class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                                        Konfirmasi
                                    </a>
                                <?php else : ?>
                                    <span class="text-gray-400 text-xs">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>