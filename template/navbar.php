<?php
require_once '../auth_guard.php';
session_start();

// dummy session (hapus kalau sudah ada)
$_SESSION['username'] = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Navbar | Perpustakaan LP3I</title>
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

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-100">

<!-- NAVBAR -->
<header class="fixed top-0 left-64 right-0 h-16 bg-white shadow-lg flex items-center justify-between px-6 z-40">

    <!-- Page Title -->
    <div>
        <h1 class="text-lg font-semibold text-primary">
            Dashboard
        </h1>
        <p class="text-xs text-slate-500">
            Sistem Informasi Perpustakaan
        </p>
    </div>

    <!-- Right Menu -->
    <div class="flex items-center gap-4">

        <!-- User Info -->
        <div class="text-right leading-tight">
            <p class="text-sm font-medium text-slate-700">
                <?= $_SESSION['username']; ?>
            </p>
        </div>

        <!-- Logout -->
        <a href="../logout.php"
           class="px-2 py-1 rounded-lg bg-accent1 text-white text-xs hover:bg-red-600 transition">
            Logout
        </a>
    </div>

</header>

</body>
</html>
