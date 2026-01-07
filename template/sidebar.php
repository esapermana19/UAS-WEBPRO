<?php
session_start();
// contoh dummy session (boleh dihapus kalau sudah ada)
$_SESSION['role']  = $_SESSION['role']  ?? 'Admin';
$_SESSION['name']  = $_SESSION['name']  ?? 'Petugas Perpustakaan';
$_SESSION['email'] = $_SESSION['email'] ?? 'admin@lp3i.ac.id';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sidebar | Perpustakaan LP3I</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
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

    <!-- Alpine.js (dropdown) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-100">

<!-- SIDEBAR -->
<aside class="w-64 min-h-screen bg-primary text-white fixed left-0 top-0 flex flex-col">

    <!-- Brand -->
    <div class="px-6 py-5 border-b border-white/20">
        <h1 class="text-lg font-bold tracking-wide">
            Perpustakaan LP3I
        </h1>
        <p class="text-xs text-white/70">
            <?= $_SESSION['role']; ?>
        </p>
    </div>

    <!-- User Panel -->
    <div class="px-6 py-4 border-b border-white/10">
        <p class="text-sm font-semibold">
            <?= $_SESSION['name']; ?>
        </p>
        <p class="text-xs text-white/70">
            <?= $_SESSION['email']; ?>
        </p>
    </div>

    <!-- Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="dashboard.php"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
            <span class="w-2 h-2 rounded-full bg-accent2"></span>
            Dashboard
        </a>

        <!-- Data Master -->
        <div x-data="{ open: true }">
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/10 transition"
            >
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-accent1"></span>
                    Data Master
                </div>
                <svg class="w-4 h-4 transition-transform"
                     :class="open ? 'rotate-180' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-transition class="mt-2 ml-6 space-y-1">
                <a href="users.php" class="block px-4 py-2 rounded-lg hover:bg-white/10">
                    Users
                </a>
                <a href="anggota.php" class="block px-4 py-2 rounded-lg hover:bg-white/10">
                    Anggota
                </a>
                <a href="buku.php" class="block px-4 py-2 rounded-lg hover:bg-white/10">
                    Buku
                </a>
                <a href="kategori.php" class="block px-4 py-2 rounded-lg hover:bg-white/10">
                    Kategori
                </a>
            </div>
        </div>

        <!-- Peminjaman -->
        <a href="peminjaman.php"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
            <span class="w-2 h-2 rounded-full bg-accent2"></span>
            Peminjaman
        </a>
    </nav>

</aside>

<!-- Dummy content agar kelihatan -->
<main class="ml-64 p-8">
    <h2 class="text-2xl font-bold text-primary">
        Sidebar Standalone Aktif ✅
    </h2>
    <p class="mt-2 text-slate-600">
        Sidebar ini bisa dibuka langsung dan siap diintegrasikan ke halaman lain.
    </p>
</main>

</body>
</html>
