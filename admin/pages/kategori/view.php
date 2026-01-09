<?php
// asumsi: session & koneksi sudah dipanggil sebelumnya
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-2 pb-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">Kategoi Buku</h1>

            <nav class="text-sm text-gray-500">
                <ol class="flex space-x-2">
                    <li><a href="#" class="hover:text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-700 font-medium">Kategori Buku</li>
                </ol>
            </nav>
        </div>



        <!-- CARD BODY -->
        <div class="p-6">

            <!-- BUTTON ADD -->
            <a href="dashboard.php?page=tambah_kategori"
                class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Tambah Kategori
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
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">ID Kategori</th>
                            <th class="px-4 py-3">Nama Kategori</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php
                        $no = 1;
                        $sql = "SELECT * FROM kategori ORDER BY kategori_id ASC";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kategori = mysqli_fetch_array($query)):
                        ?>
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="px-4 py-3"><?php echo $no++; ?></td>
                                <td class="px-4 py-3"><?php echo $kategori['kategori_id']; ?></td>
                                <td class="px-4 py-3"><?php echo $kategori['nama_kategori']; ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="dashboard.php?page=edit_kategori&kategori_id=<?php echo $kategori['kategori_id']; ?>"
                                            class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600">
                                            Edit
                                        </a>
                                        <a href="pages/kategori/action.php?act=delete&kategori_id=<?php echo $kategori['kategori_id']; ?>"
                                            onclick="return confirm('Are you sure, Delete data?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600">
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