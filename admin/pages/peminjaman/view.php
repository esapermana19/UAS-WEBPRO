<?php
// asumsi: session & koneksi sudah dipanggil sebelumnya
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-2 pb-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">Peminjaman</h1>

            <nav class="text-sm text-gray-500">
                <ol class="flex space-x-2">
                    <li><a href="#" class="hover:text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-700 font-medium">Peminjaman</li>
                </ol>
            </nav>
        </div>



        <!-- CARD BODY -->
        <div class="p-6">

            <!-- BUTTON ADD -->
            <a href="dashboard.php?page=tambah_peminjaman"
                class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Tambah Peminjaman
            </a>

            <!-- ALERT -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="mb-4 px-4 py-3 rounded-lg 
                    <?php echo $_SESSION['type'] == 'success'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700'; ?>">
                    <strong class="capitalize">
                        <?php echo $_SESSION['type']; ?>!
                    </strong>
                    <p><?php echo $_SESSION['message']; ?></p>
                </div>
            <?php
                unset($_SESSION['message']);
                unset($_SESSION['alert_type']);
                unset($_SESSION['type']);
            endif;
            ?>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 text-sm text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">ID Peminjaman</th>
                            <th class="px-4 py-3 text-left">Kode Anggota</th>
                            <th class="px-4 py-3 text-left">Nama Anggota</th>
                            <th class="px-4 py-3 text-left">Jumlah Buku</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $no = 1;
                        $sql = "
                        SELECT 
                            p.id_peminjaman,
                            p.kode_anggota,
                            a.nama_anggota,
                            COUNT(dp.id_detail_peminjaman) AS total_buku
                        FROM peminjaman p
                        JOIN anggota a ON p.kode_anggota = a.kode_anggota
                        JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
                        GROUP BY p.id_peminjaman
                        ORDER BY p.id_peminjaman DESC";
                        $query = mysqli_query($koneksi, $sql);

                        while ($row = mysqli_fetch_assoc($query)) : ?>
                            <tr class="text-sm hover:bg-gray-50">
                                <td class="px-4 py-3"><?= $no++; ?></td>
                                <td class="px-4 py-3"><?= $row['id_peminjaman']; ?></td>
                                <td class="px-4 py-3"><?= $row['kode_anggota']; ?></td>
                                <td class="px-4 py-3"><?= $row['nama_anggota']; ?></td>
                                <td class="px-4 py-3"><?= $row['total_buku']; ?></td>
                                <td class="px-4 py-3">
                                    <a href="dashboard.php?page=detail_peminjaman&id=<?= $row['id_peminjaman']; ?>"
                                        class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-600">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-xl shadow">


        </div>
    </div>

</body>

</html>