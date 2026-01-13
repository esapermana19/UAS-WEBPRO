<?php
// Landing Page - Aplikasi Perpustakaan LP3I
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan LP3I</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00426D',
                        accent1: '#F15C67',
                        accent2: '#00AEB6',
                    }
                }
            }
        }
    </script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-700">

<!-- Navbar -->
<nav class="fixed w-full z-50 bg-white/70 backdrop-blur-md shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-primary">
            Perpustakaan LP3I
        </h1>
        <a href="login.php" class="px-5 py-2 rounded-lg bg-primary text-white font-medium hover:bg-accent2 transition">
            Login
        </a>
    </div>
</nav>

<!-- Hero Section -->
<section class="min-h-screen flex items-center pt-0">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        
        <!-- Text -->
        <div>
            <span class="inline-block mb-4 px-4 py-1 rounded-full bg-accent2/10 text-accent2 text-sm font-medium">
                Sistem Informasi Perpustakaan
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-primary leading-tight mb-6">
                Kelola Perpustakaan <br>
                <span class="text-accent1">Lebih Modern</span> & Efisien
                <p class="text-xl">By Esa Permana</p>
            </h2>
            <p class="text-slate-600 mb-8 leading-relaxed">
                Aplikasi Perpustakaan LP3I membantu pengelolaan data buku, peminjaman,
                pengembalian, dan laporan secara terintegrasi dengan tampilan modern
                dan profesional.
            </p>

            <div class="flex gap-4">
                <a href="login.php" class="px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-accent2 transition shadow-lg">
                    Mulai Sekarang
                </a>
            </div>
        </div>

        <!-- Visual Card -->
        <div class="relative">
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">
                <h3 class="text-lg font-semibold text-primary mb-4">
                    Fitur Unggulan
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-accent1"></span>
                        Manajemen Data Buku
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-accent2"></span>
                        Peminjaman & Pengembalian
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        Laporan Perpustakaan
                    </li>
                </ul>
            </div>

            <!-- Decorative -->
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-accent1/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-accent2/20 rounded-full blur-2xl"></div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white py-8">
    <div class="max-w-7xl mx-auto px-6 text-center text-sm">
        © <?= date('Y') ?> Perpustakaan LP3I. All rights reserved.
    </div>
</footer>

</body>
</html>
