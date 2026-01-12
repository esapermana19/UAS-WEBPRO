<?php
require_once '../auth_guard.php';

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Perpustakaan LP3I</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen">

    <!-- SIDEBAR -->
    <?php include "../template/sidebar.php"; ?>

    <!-- MAIN CONTENT (WRAPPER) -->
    <main class="lg:ml-64 min-h-screen px-6 py-6">

        <!-- HEADER / NAVBAR -->
        <?php include "../template/navbar.php"; ?>

        <!-- CONTENT -->
        <section class="bg-white rounded-xl shadow p-6 mt-20">
            <?php include "content.php"; ?>
        </section>

    </main>

</body>

</html>