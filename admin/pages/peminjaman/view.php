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

            <div class="flex flex-col md:flex-row justify-between items-center w-full gap-4 mb-4">
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="dashboard.php?page=tambah_peminjaman"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm whitespace-nowrap">
                        Tambah Peminjaman
                    </a>

                    <form action="" method="GET" class="flex gap-2">
                        <input type="hidden" name="page" value="peminjaman">

                        <input type="text" name="search"
                            value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
                            placeholder="Cari nama"
                            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition text-sm">
                            Cari
                        </button>

                        <?php if (isset($_GET['search'])): ?>
                            <a href="dashboard.php?page=peminjaman"
                                class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 transition text-sm">
                                Reset
                            </a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="w-full md:w-auto flex justify-end">
                    <a href="pages/peminjaman/print.php?<?= http_build_query($_GET) ?>"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition"
                        target="_blank">
                        Print
                    </a>
                </div>
            </div>

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
                        // Logika Pencarian
                        $where = "";
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = mysqli_real_escape_string($koneksi, $_GET['search']);
                            $where = " WHERE a.nama_anggota LIKE '%$search%' OR p.id_peminjaman LIKE '%$search%' ";
                        }

                        $sql = "SELECT 
                            p.id_peminjaman,
                            p.kode_anggota,
                            a.nama_anggota,
                            COUNT(dp.kode_buku) AS total_buku
                        FROM peminjaman p
                        JOIN anggota a ON p.kode_anggota = a.kode_anggota
                        JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
                        $where
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
                                        class="bg-blue-600 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-700">
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