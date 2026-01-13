<?php
require_once '../auth_guard.php';
// TAMBAHKAN INI: Sesuaikan path dengan letak file koneksi Anda
include "../config/koneksi.php"; 

// Hitung data untuk statistik secara dinamis
$total_buku     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$total_anggota  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM anggota"));

// Query untuk yang sedang dipinjam (Status 'Dipinjam')
$sql_pinjam     = "SELECT COUNT(*) as total FROM detail_peminjaman WHERE status = 'Dipinjam'";
$res_pinjam     = mysqli_query($koneksi, $sql_pinjam);
$data_pinjam    = mysqli_fetch_assoc($res_pinjam);

// Query untuk yang sudah kembali
$sql_kembali    = "SELECT COUNT(*) as total FROM detail_peminjaman WHERE status = 'Kembali'";
$res_kembali    = mysqli_query($koneksi, $sql_kembali);
$data_kembali   = mysqli_fetch_assoc($res_kembali);
?>
<body class="bg-slate-100 min-h-screen">
    <?php include "../template/sidebar.php"; ?>

    <main class="lg:ml-64 min-h-screen flex flex-col">
        <?php include "../template/navbar.php"; ?>

        <div class="px-6 py-6 mt-16"> 
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, <?php echo $_SESSION['username']?>! 👋</h1>
                <p class="text-gray-500 text-sm">Berikut adalah ringkasan perpustakaan Anda hari ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition duration-300">
                    <div class="p-3 bg-blue-50 rounded-xl mr-4 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Buku</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $total_buku; ?></h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition duration-300">
                    <div class="p-3 bg-purple-50 rounded-xl mr-4 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Anggota</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $total_anggota; ?></h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition duration-300">
                    <div class="p-3 bg-orange-50 rounded-xl mr-4 text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Dipinjam</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $data_pinjam['total']; ?></h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition duration-300">
                    <div class="p-3 bg-green-50 rounded-xl mr-4 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Kembali</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $data_kembali['total']; ?></h3>
                    </div>
                </div>
            </div>

            <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <?php include "content.php"; ?>
            </section>

        </div>
    </main>
</body>