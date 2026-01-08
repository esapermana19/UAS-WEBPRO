<?php
// login.php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Perpustakaan LP3I</title>
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

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-primary via-primary to-accent2 flex items-center justify-center px-4">

    <!-- Login Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 relative">

        <!-- Decorative -->
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-accent1/20 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-accent2/20 rounded-full blur-2xl"></div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-primary mb-2">
                Perpustakaan LP3I
            </h1>
            <p class="text-slate-500 text-sm">
                Silakan login untuk melanjutkan
            </p>
        </div>
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
        ?>
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

                <!-- Message -->
                <div class="flex-1 text-sm">
                    <p class="font-semibold">Login Gagal</p>
                    <p><?= $_SESSION['message']; ?></p>
                </div>

                <!-- Close -->
                <button onclick="this.parentElement.remove()"
                    class="text-red-400 hover:text-red-600 font-bold">
                    ✕
                </button>
            </div>
        <?php
            unset($_SESSION['message']);
        }
        ?>

        <!-- Form -->
        <form action="auth.php" method="POST" class="space-y-5">

            <!-- email -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Email
                </label>
                <input
                    type="text"
                    name="email"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent2 focus:outline-none"
                    placeholder="Masukkan email">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent2 focus:outline-none"
                    placeholder="Masukkan password">
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-primary text-white font-semibold hover:bg-accent2 transition shadow-lg">
                Login
            </button>

        </form>

        <!-- Footer -->
        <div class="text-center mt-6 text-sm text-slate-500">
            © <?= date('Y') ?> Perpustakaan LP3I
        </div>
    </div>

</body>

</html>