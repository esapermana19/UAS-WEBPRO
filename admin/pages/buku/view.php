<?php
// asumsi: session & koneksi sudah dipanggil sebelumnya
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-2 pb-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">Buku</h1>

            <nav class="text-sm text-gray-500">
                <ol class="flex space-x-2">
                    <li><a href="#" class="hover:text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-700 font-medium">Buku</li>
                </ol>
            </nav>
        </div>



        <!-- CARD BODY -->
        <div class="p-6">
            <div class="flex flex-col md:flex-row justify-between items-center w-full gap-4 mb-6">
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="dashboard.php?page=tambah_buku"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm whitespace-nowrap">
                        Tambah Buku
                    </a>

                    <form action="" method="GET" class="flex gap-2">
                        <input type="hidden" name="page" value="buku">

                        <input type="text" name="search"
                            value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
                            placeholder="Cari judul atau kode..."
                            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition text-sm">
                            Cari
                        </button>

                        <?php if (isset($_GET['search'])): ?>
                            <a href="dashboard.php?page=buku"
                                class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 transition text-sm">
                                Reset
                            </a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="w-full md:w-auto flex justify-end">
                    <a href="pages/buku/print.php?<?= http_build_query($_GET) ?>"
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
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Kode Buku</th>
                            <th class="px-4 py-3">Judul Buku</th>
                            <th class="px-4 py-3">Pengarang</th>
                            <th class="px-4 py-3">Penerbit</th>
                            <th class="px-4 py-3">Tahun Terbit</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php
                        $no = 1;
                        $where = "";

                        // Logika Pencarian
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = mysqli_real_escape_string($koneksi, $_GET['search']);
                            // Mencari berdasarkan judul buku, kode buku, atau pengarang
                            $where = " WHERE buku.judul LIKE '%$search%' 
                   OR buku.kode_buku LIKE '%$search%' 
                   OR buku.pengarang LIKE '%$search%' ";
                        }

                        $sql = "SELECT * FROM buku
            INNER JOIN kategori ON buku.kategori_id = kategori.kategori_id 
            $where
            ORDER BY buku.kode_buku ASC";

                        $query = mysqli_query($koneksi, $sql);

                        if (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='9' class='px-4 py-8 text-center text-gray-500 italic'>Data buku tidak ditemukan.</td></tr>";
                        }

                        while ($buku = mysqli_fetch_array($query)):
                        ?>
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="px-4 py-3"><?php echo $no++; ?></td>
                                <td class="px-4 py-3 font-medium"><?php echo $buku['kode_buku']; ?></td>
                                <td class="px-4 py-3"><?php echo $buku['judul']; ?></td>
                                <td class="px-4 py-3"><?php echo $buku['pengarang']; ?></td>
                                <td class="px-4 py-3"><?php echo $buku['penerbit']; ?></td>
                                <td class="px-4 py-3"><?php echo $buku['tahun_terbit']; ?></td>
                                <td class="px-4 py-3">
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs"><?php echo $buku['nama_kategori']; ?></span>
                                </td>
                                <td class="px-4 py-3"><?php echo $buku['stok']; ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="dashboard.php?page=edit_buku&kode_buku=<?php echo $buku['kode_buku']; ?>"
                                            class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600 transition">
                                            Edit
                                        </a>
                                        <a href="pages/buku/action.php?act=delete&kode_buku=<?php echo $buku['kode_buku']; ?>"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600 transition">
                                            Delete
                                        </a>
                                    </div>
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